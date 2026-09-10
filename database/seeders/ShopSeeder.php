<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        $files = ['data/products.json', 'data/stoves.json'];
        $catPosition = 0;
        $slugPos = 0;

        foreach ($files as $rel) {
            $path = database_path($rel);
            if (! is_file($path)) {
                $this->command->warn("{$rel} not found — skipped.");
                continue;
            }

            $data = json_decode(file_get_contents($path), true);
            $catMap = [];

            foreach ($data['categories'] as $c) {
                // Match par source_id quand il existe (stable même si le slug a été renommé),
                // sinon par slug.
                $lookup = ! empty($c['source_id'])
                    ? ['source_id' => (int) $c['source_id']]
                    : ['slug' => (string) $c['slug']];

                $cat = Category::updateOrCreate(
                    $lookup,
                    [
                        'source_id' => $c['source_id'] ?? null,
                        'slug' => $c['slug'],
                        'name' => $c['name'],
                        'description' => $c['description'] ?? null,
                        'image' => $c['image'] ?? null,
                        'position' => $catPosition++,
                    ]
                );
                $catMap[$c['slug']] = $cat->id;
            }

            // Slugs déjà pris par d'AUTRES produits (on exclut la ligne du produit courant,
            // repérée par son source_id) — évite qu'un re-seed n'incrémente le suffixe -2, -3…
            $slugOwner = Product::pluck('source_id', 'slug')->toArray();

            foreach ($data['products'] as $p) {
                $slug = Str::slug(urldecode($p['slug'] ?: '')) ?: Str::slug($p['name']);
                $base = $slug;
                $n = 2;
                while (isset($slugOwner[$slug]) && $slugOwner[$slug] !== ($p['source_id'] ?? null)) {
                    $slug = $base . '-' . $n++;
                }
                $slugOwner[$slug] = $p['source_id'] ?? null;

                $product = Product::updateOrCreate(
                    ['source_id' => $p['source_id'] ?? null],
                    [
                        'slug' => $slug,
                        'source_id' => $p['source_id'] ?? null,
                        'name' => $p['name'],
                        'sku' => $p['sku'] ?? null,
                        'type' => $p['type'] ?? 'simple',
                        'short_description' => $p['short_description'] ?? null,
                        'description' => $p['description'] ?? null,
                        'permalink' => $p['permalink'] ?? null,
                        'price' => $p['price'],
                        'regular_price' => $p['regular_price'],
                        'sale_price' => $p['sale_price'],
                        'on_sale' => $p['on_sale'] ?? false,
                        'currency' => $p['currency'] ?? 'EUR',
                        'in_stock' => $p['in_stock'] ?? true,
                        'stock_availability' => $p['stock_availability'] ?? null,
                        'weight' => $p['weight'] ?? null,
                        'formatted_weight' => $p['formatted_weight'] ?? null,
                        'dimensions' => is_array($p['dimensions'] ?? null)
                            ? trim(implode(' x ', array_filter($p['dimensions']))) ?: null
                            : ($p['dimensions'] ?? null),
                        'average_rating' => $p['average_rating'] ?? 0,
                        'review_count' => $p['review_count'] ?? 0,
                        'is_featured' => $slugPos++ % 5 === 0,
                    ]
                );

                $ids = collect($p['categories'])->map(fn ($s) => $catMap[$s] ?? null)->filter()->all();
                $product->categories()->sync($ids);

                $product->images()->delete();
                foreach ($p['images'] as $img) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $img['file'],
                        'alt' => $img['alt'] ?? $p['name'],
                        'source' => $img['source'] ?? null,
                        'position' => $img['position'] ?? 0,
                        'is_primary' => $img['is_primary'] ?? false,
                    ]);
                }
            }
        }

        $this->command->info('Seeded ' . Category::count() . ' categories, ' . Product::count() . ' products, ' . ProductImage::count() . ' images.');
    }
}
