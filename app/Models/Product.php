<?php

namespace App\Models;

use App\Enums\MediaType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['title', 'desc', 'category_id', 'meta'];

    protected $casts = [
        'meta' => 'collection',
    ];

    function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute', 'product_id', 'attribute_id')->withPivot(['parent_attr_id']);
    }
    /**
     * [[parent_id] => [data data nya, child : []]]
     * 
     */
    // function getTree() {
    //     $attr = $this->attributes;

    //     return 
    // }

    function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    // Root Of Medias
    function medias()
    {
        return $this->hasMany(Media::class, 'product_id');
    }


    // Image Variant ======================
    function thumbnail()

    {
        return $this->medias()->where('attr_id', null)->where('type', MediaType::THUMBNAIL);
    }

    function variantImages()
    {
        return $this->medias()->whereNot('attr_id', null)->whereNot('type', MediaType::THUMBNAIL);
    }

    function variantImage($attr_id)
    {
        $media =  $this->medias()->where('attr_id', $attr_id)->where('type')->get();

        return !$media->isEmpty() ? $media : $this->medias()->where('attr_id', null)->whereNot('type', MediaType::THUMBNAIL);
    }
}
