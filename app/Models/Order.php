<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUS = ['pending' => 'Menunggu', 'preparing' => 'Diproses', 'ready' => 'Siap diambil', 'completed' => 'Selesai'];

    public const NEXT = ['pending' => 'preparing', 'preparing' => 'ready', 'ready' => 'completed'];

    protected $fillable = ['user_id', 'checkout_token', 'total', 'pickup', 'pickup_time', 'note'];

    protected $hidden = ['checkout_token'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pickupLabel(): string
    {
        return match ($this->pickup) {
            'after_class' => 'Habis kelas (13.00 WIB)',
            'scheduled' => substr($this->pickup_time, 0, 5).' WIB',
            default => 'Secepatnya',
        };
    }
}
