<?php

namespace CodeDelivery\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class OrderItem extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity'
    ];

    public function presenter()
    {
        return \CodeDelivery\Fractal\Presenters\OrderItemPresenter::class;
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
