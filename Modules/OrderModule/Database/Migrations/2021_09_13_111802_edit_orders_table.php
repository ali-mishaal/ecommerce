<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditOrdersTable extends Migration
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
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('fees_calculation');
            });
        }

        Schema::table('orders', function (Blueprint $table) {
           $table->double('driver_fees')->default(0)->after('order_fees');
           $table->double('company_fees')->default(0)->after('order_fees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(!Schema::hasColumn('orders', 'fees_calculation'))
        {
            Schema::table('orders', function (Blueprint $table) {
                $table->double('fees_calculation')->after('order_fees');
            });
        }

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('driver_fees');
            $table->dropColumn('company_fees');
        });
    }
}
