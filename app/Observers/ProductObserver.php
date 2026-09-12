<?php

namespace App\Observers;

use App\Models\Product;
use App\Services\ProductFeed;
use App\Services\ProductFeedTsv;

class ProductObserver
{
    /** Feed-Cache invalidieren, sobald sich ein Produkt ändert. */
    public function saved(Product $product): void
    {
        $this->invalidate();
    }

    public function deleted(Product $product): void
    {
        $this->invalidate();
    }

    private function invalidate(): void
    {
        (new ProductFeed())->forget();
        (new ProductFeedTsv())->forget();
    }
}
