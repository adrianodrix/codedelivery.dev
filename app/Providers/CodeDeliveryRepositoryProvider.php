<?php

namespace CodeDelivery\Providers;

use Illuminate\Support\ServiceProvider;

class CodeDeliveryRepositoryProvider extends ServiceProvider
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
    }
}
