<?php

namespace App\Builder;

use App\Models\Product;

class ComProduct
{
    protected $attributesId = [];

    /**
     * 
     * @return static
     */
    static function prod(Product $product)
    {
        new static($product);
    }

    static function generateUnique(Product $product, $attrId = [])
    {
        return (static::prod($product))->addAttr($attrId)->makeUniqueId();
    }

    function __construct(private Product $product)
    {
    }

    /**
     *  
     * @param int|array $attrId
     */
    function addAttr($attrId)
    {
        if (!is_array($attrId))
            return $this->attributesId[] = $attrId;

        array_push($this->attributesId, $attrId);

        return $this;
    }

    function getAttr()
    {
        return $this->attributesId;
    }

    function makeUniqueId(): string
    {
        return "{$this->product->id}-" . join('-', $this->attributesId);
    }
}
