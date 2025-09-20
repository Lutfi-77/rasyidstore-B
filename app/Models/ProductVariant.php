<?php

namespace App\Models;

use App\Models\Attribute as ModelsAttribute;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variant';

    protected $fillable = ['stock', 'price', 'is_ready', 'prod_attr_id', ''];

    public $timestamps = false;

    // private $tmp;

    protected $casts = [
        'type' => AttributeType::class,
        // 'meta_attr' => 'collection',
        'is_ready' => 'boolean'
    ];

    function variants()
    {

        $attributes = $this->product->attributes()->get();
        $prodVar = $attributes->where('id', $this->prod_attr_id)->first();
        $attr = [$prodVar]; 

        if ($prodVar->pivot->parent_attr_id) {
            $attr[1] = $attr[0];
            $attr[0] = ModelsAttribute::find($prodVar->pivot->parent_attr_id);
        }

        return $attr;
    }

    function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    function comments()
    {

        return $this->belongsToMany(User::class, 'comments', 'prod_variant_id', 'user_id')->withPivot(['comment']);
    }
}
