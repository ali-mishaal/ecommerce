<?php

use Illuminate\Support\Facades\Schema;
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
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->unsignedBigInteger('new_supervisor_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('new_driver_id')->nullable();
            $table->boolean('driver_approved')->default(false);


            $table->string('address');
            $table->string('mobile')->nullable();
            $table->double('amount');
            $table->double('order_fees');
            $table->double('fees_calculation');
            $table->boolean('is_urgent')->default(false);
            $table->dateTime('delivery_time');
            $table->string('customer_area');
            $table->string('customer_mobile');
            $table->string('customer_name');

            $table->boolean('is_from_client')->default(true);
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
