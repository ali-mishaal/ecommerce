<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsToNullableInClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_type_id')->nullable()->change();
            $table->unsignedBigInteger('payment_method_id')->nullable()->change();
            $table->float('fees')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_type_id')->change();
            $table->unsignedBigInteger('payment_method_id')->change();
            $table->float('fees')->change();
        });

    }
}
