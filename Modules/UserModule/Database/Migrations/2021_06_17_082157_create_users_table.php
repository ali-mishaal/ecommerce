<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('user');
            $table->string('username')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('name');
            $table->string('civil_id')->nullable();
            $table->string('address');
            $table->string('mobile');
            $table->string('image')->nullable();
            $table->boolean('type')->default(1);
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
        Schema::dropIfExists('users');
    }
}
