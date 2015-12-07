<?php

namespace CodeDelivery\Entities;

use CodeDelivery\Fractal\Presenters\ProductPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Product extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
