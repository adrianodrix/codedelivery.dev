<?php

use CodeDelivery\Entities\Order;
use CodeDelivery\Entities\OrderItem;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_items')->delete();
        DB::table('orders')->delete();
        factory(Order::class, 10)->create();
        factory(OrderItem::class, 100)->create();
    }
}
