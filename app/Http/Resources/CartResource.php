<?php

namespace App\Http\Resources;

use App\Models\Attribute;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->product->product->title,
            'price' => $this->product->price,
            'qty' => $this->quantity,
            'variants' => $variants,
        ];
        // return parent::toArray($request);
    }
}
