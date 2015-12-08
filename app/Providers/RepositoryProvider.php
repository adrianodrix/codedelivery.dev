<?php

namespace CodeDelivery\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \CodeDelivery\Repositories\Contracts\UserRepository::class,
            \CodeDelivery\Repositories\Eloquent\UserRepositoryEloquent::class
        );
        $this->app->bind(
            \CodeDelivery\Repositories\Contracts\CategoryRepository::class,
            \CodeDelivery\Repositories\Eloquent\CategoryRepositoryEloquent::class
        );
        $this->app->bind(
            \CodeDelivery\Repositories\Contracts\ProductRepository::class,
            \CodeDelivery\Repositories\Eloquent\ProductRepositoryEloquent::class
        );
        $this->app->bind(
            \CodeDelivery\Repositories\Contracts\ClientRepository::class,
            \CodeDelivery\Repositories\Eloquent\ClientRepositoryEloquent::class
        );
        $this->app->bind(
            \CodeDelivery\Repositories\Contracts\OrderRepository::class,
            \CodeDelivery\Repositories\Eloquent\OrderRepositoryEloquent::class
        );
        $this->app->bind(
            \CodeDelivery\Repositories\Contracts\OrderItemRepository::class,
            \CodeDelivery\Repositories\Eloquent\OrderItemRepositoryEloquent::class
        );
        $this->app->bind(
            \CodeDelivery\Repositories\Contracts\CouponRepository::class,
            \CodeDelivery\Repositories\Eloquent\CouponRepositoryEloquent::class
        );
    }
}
