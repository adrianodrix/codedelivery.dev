<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients');

            $table->unsignedInteger('user_deliveryman_id')->nullable();
            $table->foreign('user_deliveryman_id')
                ->references('id')
                ->on('users');

            $table->decimal('total', 14,2)->default(0);
            $table->smallInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
