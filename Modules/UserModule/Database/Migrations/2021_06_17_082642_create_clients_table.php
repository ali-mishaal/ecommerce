<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('activity')->nullable();
            $table->string('project_data')->nullable();
            $table->unsignedBigInteger('payment_type_id');
            $table->double('limit')->default(0);
            $table->unsignedBigInteger('payment_method_id');
            $table->double('fees');
            $table->string('bank_account')->nullable();

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
        Schema::dropIfExists('clients');
    }
}
