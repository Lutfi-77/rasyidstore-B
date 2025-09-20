<?php

namespace App\Models;

use App\Enums\AttributeType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;


    protected $table = 'attributes';

    protected $fillable = ['title', 'type', 'meta_attr'];

    public $timestamps = false;

    protected $casts = [
        'type' => AttributeType::class,
        'meta_attr' => 'object',
    ];

    static function getOptions($str = false)
    {
        $attr = ['color' => [], 'size' => [], 'motive' => []];



        static::all()->each(function ($attribute) use (&$attr, $str) {
            $attrName = $attribute->type === AttributeType::COLOR ? 'color' : ($attribute->type === AttributeType::MOTIVE ? 'motive' : 'size');

            $attr[$attrName][] = ['value' => $str ? "$attribute->id" : $attribute->id, 'label' => $attribute->title, 'meta' => $attribute->meta_attr];
        });

        return $attr;
    }

    static function getTypeString($type)
    {
        return $type === AttributeType::COLOR ? 'color' : ($type === AttributeType::MOTIVE ? 'motive' : 'size');
    }

    function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute', 'attribute_id', 'product_id');
    }
}
