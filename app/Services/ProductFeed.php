<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use XMLWriter;

class ProductFeed
{
    /**
     * Baut den vollständigen Google-Merchant-Center-Feed (RSS 2.0 + g:-Namespace).
     */
    public function toXml(): string
    {
        $ttl = (int) config('feed.cache_ttl');

        if ($ttl > 0) {
            return Cache::remember('product_feed_google_xml', $ttl, fn () => $this->build());
        }

        return $this->build();
    }

    public function forget(): void
    {
        Cache::forget('product_feed_google_xml');
    }

    private function build(): string
    {
        $currency = (string) config('feed.currency', 'CHF');
        $brand = (string) config('feed.brand');
        $condition = (string) config('feed.condition', 'new');
        $googleCategory = trim((string) config('feed.google_product_category'));
        $shippingCountries = (array) config('feed.shipping_countries', []);
        $shippingService = (string) config('feed.shipping_service');

        $w = new XMLWriter();
        $w->openMemory();
        $w->setIndent(true);
        $w->startDocument('1.0', 'UTF-8');

        $w->startElement('rss');
        $w->writeAttribute('version', '2.0');
        $w->writeAttribute('xmlns:g', 'http://base.google.com/ns/1.0');
        $w->startElement('channel');

        $w->writeElement('title', (string) config('feed.title'));
        $w->writeElement('link', url('/'));
        $w->writeElement('description', (string) config('feed.description'));

        Product::with(['images', 'categories'])
            ->orderBy('id')
            ->chunk(200, function ($products) use ($w, $currency, $brand, $condition, $googleCategory, $shippingCountries, $shippingService) {
                foreach ($products as $product) {
                    $this->writeItem($w, $product, $currency, $brand, $condition, $googleCategory, $shippingCountries, $shippingService);
                }
            });

        $w->endElement(); // channel
        $w->endElement(); // rss
        $w->endDocument();

        return $w->outputMemory();
    }

    private function writeItem(
        XMLWriter $w,
        Product $product,
        string $currency,
        string $brand,
        string $condition,
        string $googleCategory,
        array $shippingCountries,
        string $shippingService
    ): void {
        $images = $product->images;
        $primary = $images->firstWhere('is_primary', true) ?? $images->first();

        // Ohne Bild darf der Artikel nicht im Feed erscheinen (GMC-Pflichtfeld).
        if (! $primary) {
            return;
        }

        $price = (float) $product->price;
        $regular = (float) ($product->regular_price ?: $product->price);
        $onSale = (bool) $product->on_sale && $regular > $price;

        $description = $this->plainText($product->description ?: $product->short_description ?: $product->name);

        $w->startElement('item');

        $w->writeElement('g:id', (string) $product->id);
        $w->writeElement('title', Str::limit($product->name, 150, ''));

        $w->startElement('description');
        $w->writeCdata($description !== '' ? $description : $product->name);
        $w->endElement();

        $w->writeElement('link', route('product.show', $product->slug));
        $w->writeElement('g:image_link', $primary->url);

        foreach ($images->reject(fn ($img) => $img->id === $primary->id)->take(10) as $img) {
            $w->writeElement('g:additional_image_link', $img->url);
        }

        $w->writeElement('g:availability', $product->in_stock ? 'in_stock' : 'out_of_stock');
        $w->writeElement('g:condition', $condition);

        // Preis: bei Aktion ist g:price der reguläre Preis, g:sale_price der Aktionspreis.
        $w->writeElement('g:price', $this->money($onSale ? $regular : $price, $currency));
        if ($onSale) {
            $w->writeElement('g:sale_price', $this->money($price, $currency));
        }

        $w->writeElement('g:brand', $brand);

        // Brennholz hat üblicherweise keine GTIN/MPN.
        if (! empty($product->sku)) {
            $w->writeElement('g:mpn', (string) $product->sku);
            $w->writeElement('g:identifier_exists', 'yes');
        } else {
            $w->writeElement('g:identifier_exists', 'no');
        }

        if ($googleCategory !== '') {
            $w->writeElement('g:google_product_category', $googleCategory);
        }

        $productType = $product->categories->pluck('name')->filter()->implode(' > ');
        if ($productType !== '') {
            $w->writeElement('g:product_type', $productType);
        }

        if (! empty($product->weight) && is_numeric($product->weight)) {
            $w->writeElement('g:shipping_weight', rtrim(rtrim(number_format((float) $product->weight, 2, '.', ''), '0'), '.') . ' kg');
        }

        foreach ($shippingCountries as $country) {
            $w->startElement('g:shipping');
            $w->writeElement('g:country', $country);
            $w->writeElement('g:service', $shippingService);
            $w->writeElement('g:price', $this->money(0, $currency));
            $w->endElement();
        }

        $w->endElement(); // item
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
