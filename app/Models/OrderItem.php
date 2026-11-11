<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['menu_id', 'name', 'stand', 'unit_price', 'quantity'];
}
