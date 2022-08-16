<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'status'         => $this->status,
            'product'        => new ProductResource($this->product),
            'client'         => $this->client,
            'quantity'       => $this->quantity,
            'amount'         => $this->amount,
            'date_requested' => $this->date_requested
        ];
    }
}
