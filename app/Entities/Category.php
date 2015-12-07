<?php

namespace CodeDelivery\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Category extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
