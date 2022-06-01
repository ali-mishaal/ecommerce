<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropCustomerAreaFromOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('orders', 'customer_area')){
            Schema::table('orders', function (Blueprint $table){
                $table->dropColumn('customer_area');
            });
        };
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('orders', 'customer_area')){
            Schema::table('orders', function (Blueprint $table){
                $table->string('customer_area')->after('delivery_time');
            });
        };
    }
}
