w<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerAddressToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('caddress_name')->nullable();
            $table->integer('cgovernment')->nullable();
            $table->integer('cregion')->nullable();
            $table->string('cwidget')->nullable();
            $table->string('cstreet')->nullable();
            $table->string('cavenue')->nullable();
            $table->string('chome_number')->nullable();
            $table->string('cfloor')->nullable();
            $table->string('cflat')->nullable();
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
