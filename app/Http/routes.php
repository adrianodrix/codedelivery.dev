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

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['prefix' => 'api/v1', 'middleware' => 'oauth', 'as' => 'api.v1.'], function(){
   Route::get('/test', ['as' => 'test', function(){
       return app()->make('CodeDelivery\Repositories\Contracts\ClientRepository')->all();
   }]);
});