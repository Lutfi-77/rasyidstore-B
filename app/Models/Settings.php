<?php

namespace App\Models;

use App\Enums\MediaType;
use Illuminate\Database\Eloquent\Casts\Attribute as ModelAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Settings extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'settings';

    protected $fillable = ['name', 'value'];

    protected $casts = [
        'value' => 'collection',
    ];

    static function getByKey($key)
    {
        $s = Settings::where('name', $key)->first();

        // dd($s);

        return $s ? $s->value : collect([]);
    }
}
