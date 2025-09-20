<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = ['transaction_id', 'prod_variant_id', 'user_id', 'quantity'];

    public $timestamps = false;

    function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    function product()
    {
        return $this->belongsTo(ProductVariant::class, 'prod_variant_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
