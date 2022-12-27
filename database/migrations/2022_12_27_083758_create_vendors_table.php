<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address') -> nullable();
            $table->string('city') -> nullable();
            $table->string('sate') -> nullable();
            $table->string('country') -> nullable();
            $table->string('pincode') -> nullable();
            $table->string('mobile') -> nullable();
            $table->string('email') -> unique();
            $table->tinyInteger('status') -> default(0);
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
        Schema::dropIfExists('vendors');
    }
};
