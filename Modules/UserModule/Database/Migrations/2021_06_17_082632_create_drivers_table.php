<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->boolean('has_sallary')->default(0);
            $table->double('sallary')->default(0);
            $table->boolean('has_commission')->default(0);
            $table->double('commission')->default(0);
            $table->boolean('has_company_vehicle');
            $table->unsignedBigInteger('company_vehicle_id');
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
        Schema::dropIfExists('drivers');
    }
}
