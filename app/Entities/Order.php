<?php

namespace CodeDelivery\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = [
        'client_id',
        'user_deliveryman_id',
        'total',
        'status',
        'coupon_id'
    ];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function DeliveryMan()
    {
        return $this->belongsTo(User::class, 'user_deliveryman_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
