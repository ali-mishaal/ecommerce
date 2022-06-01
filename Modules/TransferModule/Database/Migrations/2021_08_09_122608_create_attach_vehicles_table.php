<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attach_vehicles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('driver_id');

            $table->string('request_vehicle_image')->nullable();
            $table->string('request_km_image')->nullable();
            $table->string('request_km')->nullable();
            $table->text('request_note')->nullable();
            $table->boolean('supervisor_status')->default(false);

            $table->string('driver_plate_image')->nullable();
            $table->string('driver_km_image')->nullable();
            $table->boolean('driver_status')->default(false);
            $table->nullableMorphs('created_by');


            $table->softDeletes();

            $table->timestamps();

            $table->foreign('vehicle_id')->references('id')->on('company_vehicles')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attach_vehicles');
    }
}
