<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
    return view('app');
});

Route::post('/oauth/access_token', ['as' => 'oauth.access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
}]);


Route::group(['prefix' => 'api/v1', 'as' => 'api.v1.'], function(){

    Route::resource('/user', 'API\\Admin\\UserController', ['only' => ['store']]);
    Route::post('/user/forgot-password', ['as' => 'user.forgot-password', 'uses' => 'API\\Admin\\UserController@forgotPassword']);

    Route::group(['middleware' => 'oauth'], function(){
        Route::get('/user/authenticated', ['as' => 'user.authenticated', 'uses' => 'API\\Admin\\UserController@authenticated']);

        Route::group(['prefix' => 'admin', 'middleware' => 'oauth.checkrole:admin','as' => 'admin.'], function(){
            Route::resource('/category',    'API\\Admin\\CategoryController');
            Route::resource('/product',     'API\\Admin\\ProductController');
            Route::resource('/client',      'API\\Admin\\ClientController');
            Route::resource('/order',       'API\\Admin\\OrderController');
            Route::resource('/coupon',      'API\\Admin\\CouponController');
        });

        Route::group(['prefix' => 'client', 'middleware' => 'oauth.checkrole:client','as' => 'client.'], function(){

        });

        Route::group(['prefix' => 'deliveryman', 'middleware' => 'oauth.checkrole:deliveryman','as' => 'deliveryman.'], function(){

        });
    });
});