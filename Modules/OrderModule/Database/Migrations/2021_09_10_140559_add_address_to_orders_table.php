<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('address_name')->nullable();
            $table->integer('government')->nullable();
            $table->integer('region')->nullable();
            $table->string('widget')->nullable();
            $table->string('street')->nullable();
            $table->string('avenue')->nullable();
            $table->string('home_number')->nullable();
            $table->string('floor')->nullable();
            $table->string('flat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {

        });
    }
}
