<?php

namespace App\Models;

use App\Enums\MediaType;
use Illuminate\Database\Eloquent\Casts\Attribute as ModelAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'media';

    protected $fillable = ['file_path', 'type', 'attr_id'];

    protected $casts = [
        'type' => MediaType::class,
    ];


    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {

            Storage::disk('public')->delete($model->file_path);
        });
    }

    function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
