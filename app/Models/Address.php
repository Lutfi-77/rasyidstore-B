<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'address';

    /**
     * District = kecamatan
     * 
     */
    protected $fillable = ['reciver_name', 'no_telp', 'disctrict', 'city', 'zip_code', 'map_link_location', 'description'];

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    static function getPrimaryAddress()
    {
        // temporary
        return Auth::user()->addresses->first();
    }
}
