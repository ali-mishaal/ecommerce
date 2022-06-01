<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address_name')->nullable();
            $table->unsignedBigInteger('government_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->string('widget')->nullable();
            $table->string('street')->nullable();
            $table->string('avenue')->nullable();
            $table->string('home_number')->nullable();
            $table->string('floor')->nullable();
            $table->string('flat')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
