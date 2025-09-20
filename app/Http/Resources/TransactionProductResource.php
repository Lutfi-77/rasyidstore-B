<?php

namespace App\Http\Resources;

use App\Models\Attribute;
use App\Models\ProductVariant;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Recive parameter
 *  ['quantity','product']
 */
class TransactionProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $variants = [];

        foreach ($this->product->variants() as $variant) {
            $variants[Attribute::getTypeString($variant->type)] = $variant;
        };

        return [
            'id' => $this->id ?? $this->product->id,
            'quantity' => $this->quantity,
            'title' => $this->product->product->title,
            'variants' => $variants,
            'price' => $this->product->price,
            'stock' => $this->product->stock,
            'image' =>
            "https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=250&q=80"
        ];
    }
}
