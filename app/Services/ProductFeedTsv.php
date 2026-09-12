<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ProductFeedTsv
{
    /** Spaltenreihenfolge des TSV-Backup-Feeds (Google-Shopping-Standardnamen). */
    private const HEADERS = [
        'id', 'title', 'description', 'link', 'image_link', 'availability',
        'price', 'sale_price', 'brand', 'gtin', 'mpn', 'condition',
        'google_product_category', 'product_type', 'item_group_id',
        'shipping(country:service:price)', 'identifier_exists',
    ];

    public function toTsv(): string
    {
        $ttl = (int) config('feed.cache_ttl');

        if ($ttl > 0) {
            return Cache::remember('product_feed_google_tsv', $ttl, fn () => $this->build());
        }

        return $this->build();
    }

    public function forget(): void
    {
        Cache::forget('product_feed_google_tsv');
    }

    private function build(): string
    {
        $currency = (string) config('feed.currency', 'CHF');
        $brand = (string) config('feed.brand');
        $condition = (string) config('feed.condition', 'new');
        $googleCategoryDefault = trim((string) config('feed.google_product_category'));
        $googleCategoryMap = (array) config('feed.google_product_category_map', []);
        $shippingCountries = (array) config('feed.shipping_countries', []);
        $shippingService = (string) config('feed.shipping_service');

        $lines = [implode("\t", self::HEADERS)];

        Product::with(['images', 'categories'])
            ->orderBy('id')
            ->chunk(200, function ($products) use (&$lines, $currency, $brand, $condition, $googleCategoryDefault, $googleCategoryMap, $shippingCountries, $shippingService) {
                foreach ($products as $product) {
                    $row = $this->buildRow($product, $currency, $brand, $condition, $googleCategoryDefault, $googleCategoryMap, $shippingCountries, $shippingService);
                    if ($row !== null) {
                        $lines[] = $row;
                    }
                }
            });

        return implode("\n", $lines) . "\n";
    }

    private function buildRow(
        Product $product,
        string $currency,
        string $brand,
        string $condition,
        string $googleCategoryDefault,
        array $googleCategoryMap,
        array $shippingCountries,
        string $shippingService
    ): ?string {
        $images = $product->images;
        $primary = $images->firstWhere('is_primary', true) ?? $images->first();

        // Ohne Bild darf der Artikel nicht im Feed erscheinen (GMC-Pflichtfeld).
        if (! $primary) {
            return null;
        }

        $price = (float) $product->price;
        $regular = (float) ($product->regular_price ?: $product->price);
        $onSale = (bool) $product->on_sale && $regular > $price;

        $gtin = trim((string) ($product->gtin ?? ''));
        $mpn = trim((string) ($product->sku ?? ''));
        $identifierExists = ($gtin === '' && $mpn === '') ? 'no' : 'yes';

        $primaryCategorySlug = $product->categories->first()?->slug;
        $googleCategory = $primaryCategorySlug !== null
            ? trim((string) ($googleCategoryMap[$primaryCategorySlug] ?? $googleCategoryDefault))
            : $googleCategoryDefault;

        $productType = $product->categories->pluck('name')->filter()->implode(' > ');

        $shipping = collect($shippingCountries)
            ->map(fn ($country) => sprintf('%s:%s:%s', $country, $shippingService, $this->money(0, $currency)))
            ->implode(';');

        $description = $this->plainText($product->description ?: $product->short_description ?: $product->name);

        $fields = [
            (string) $product->id,
            Str::limit($product->name, 150, ''),
            $description !== '' ? $description : $product->name,
            route('product.show', $product->slug),
            $primary->url,
            $product->in_stock ? 'in_stock' : 'out_of_stock',
            $this->money($onSale ? $regular : $price, $currency),
            $onSale ? $this->money($price, $currency) : '',
            $brand,
            $gtin,
            $mpn,
            $condition,
            $googleCategory,
            $productType,
            (string) ($product->item_group_id ?? ''),
            $shipping,
            $identifierExists,
        ];

        return implode("\t", array_map([$this, 'escape'], $fields));
    }

    private function escape(string $value): string
    {
        return str_replace(["\t", "\n", "\r"], ' ', $value);
    }

    private function money(float $amount, string $currency): string
    {
        return number_format($amount, 2, '.', '') . ' ' . $currency;
    }

    private function plainText(?string $html): string
    {
        $text = html_entity_decode(strip_tags((string) $html), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/\s+/u', ' ', $text);

        return Str::limit(trim($text), 4900, '');
    }
}
