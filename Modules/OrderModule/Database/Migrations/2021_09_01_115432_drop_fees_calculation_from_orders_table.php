<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropFeesCalculationFromOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('orders', 'fees_calculation'))
        {
            Schema::table('orders', function (Blueprint $table){
                $table->dropColumn('fees_calculation');

            });

            Schema::table('orders', function (Blueprint $table){
                $table->double('fees_calculation')->nullable()->after('order_fees');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
