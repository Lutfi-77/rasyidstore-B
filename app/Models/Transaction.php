<?php

namespace App\Models;

use App\Enums\CODState;
use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $fillable = ['user_id', 'address_id', 'state', 'type', 'total_amounts', 'awb', 'estimate_shipping_price'];

    public $timestamps = false;


    protected $casts = [
        'type' => TransactionType::class,
        'state' => CODState::class,
    ];


    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function orders()
    {
        return $this->hasMany(Order::class, 'transaction_id');
    }

    function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
}
