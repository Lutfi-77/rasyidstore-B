<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $variant = $this->variants;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'desc' => $this->desc,
            'category_id' => $this->category_id,
            'medias' => $this->medias,
            'meta' => $this->meta,
            'variant' => $this->resource->attributes->map(function ($attr) use ($variant) {
                $var_id = $attr->pivot->attribute_id;
                $pr_id = $attr->pivot->parent_attr_id;

                // dd($variant, $var_id, $attr);
                $var =
                    $variant->firstWhere('prod_attr_id', $var_id);

                return ['variant_id' => $var_id, 'parent_id' => $pr_id, 'id' => $var->id, 'price' => $var->price, 'stock' => $var->stock, 'is_ready' => $var->is_ready,];
            })
        ];
    }
}
