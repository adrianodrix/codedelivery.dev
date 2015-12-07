<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(CodeDelivery\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => strtolower($faker->email),
        'role' => 'client',
        'password' => bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(CodeDelivery\Entities\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(CodeDelivery\Entities\Product::class, function (Faker\Generator $faker) {
    $fakerPrice = round(rand(5, 100) + (rand(0, 99) / 10), 2);
    return [
        'category_id' => \CodeDelivery\Entities\Category::all()->lists('id')->random(1),
        'name' => $faker->sentence,
        'description' => $faker->paragraph(),
        'price' => $fakerPrice,
    ];
});

$factory->define(CodeDelivery\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'user_id' => \CodeDelivery\Entities\User::all()->lists('id')->random(1),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'postcode' => $faker->postcode,
    ];
});

$factory->define(CodeDelivery\Entities\Order::class, function (Faker\Generator $faker) {
    return [
        'client_id' => \CodeDelivery\Entities\Client::all()->lists('id')->random(1),
        'total' => $faker->numberBetween(10,100),
        'status' => $faker->numberBetween(0,2),
    ];
});

$factory->define(CodeDelivery\Entities\OrderItem::class, function (Faker\Generator $faker) {
    return [
        'order_id' => \CodeDelivery\Entities\Order::all()->lists('id')->random(1),
        'product_id' => \CodeDelivery\Entities\Product::all()->lists('id')->random(1),
        'price' => $faker->numberBetween(0,100),
        'quantity' => $faker->numberBetween(0,10),
    ];
});
