<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Sale;

class SaleObserver
{
    public function creating(Sale $sale)
    {
        $product = Product::where('id', $sale->product_id)->first();

        $product->decrement('stock', $sale->quantity);

        $sale->amount = $product->price * $sale->quantity;
    }

    /**
     * Handle the Sale "created" event.
     *
     * @param \App\Models\Sale $sale
     * @return void
     */
    public function created(Sale $sale)
    {
        //
    }

    /**
     * Handle the Sale "updated" event.
     *
     * @param \App\Models\Sale $sale
     * @return void
     */
    public function updated(Sale $sale)
    {
       //
    }

    /**
     * Handle the Sale "deleting" event.
     *
     * @param \App\Models\Sale $sale
     * @return void
     */
    public function deleting(Sale $sale)
    {
        $product = Product::where('id', $sale->product_id)->first();

        $product->increment('stock', $sale->quantity);
    }

    /**
     * Handle the Sale "deleted" event.
     *
     * @param \App\Models\Sale $sale
     * @return void
     */
    public function deleted(Sale $sale)
    {
        //
    }

    /**
     * Handle the Sale "restored" event.
     *
     * @param \App\Models\Sale $sale
     * @return void
     */
    public function restored(Sale $sale)
    {
        //
    }

    /**
     * Handle the Sale "force deleted" event.
     *
     * @param \App\Models\Sale $sale
     * @return void
     */
    public function forceDeleted(Sale $sale)
    {
        //
    }
}
