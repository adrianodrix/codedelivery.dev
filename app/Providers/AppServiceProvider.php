<?php

namespace CodeDelivery\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Faker with pt_BR Language
        $this->app->singleton(FakerGenerator::class, function(){
            return FakerFactory::create('pt_BR');
        });

        //Translate Carbon diff for humans
        Carbon::setLocale($this->app->getLocale());
    }
}
