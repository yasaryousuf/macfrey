<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('component_id');
            $table->string('position')->nullable();
            $table->string('wheel_diameter')->nullable();
            $table->string('construction')->nullable();
            $table->string('rated_voltage')->nullable();
            $table->string('n0')->nullable();
            $table->string('rated_power')->nullable();
            $table->string('nT')->nullable();
            $table->string('max_torque')->nullable();
            $table->string('efficiency')->nullable();
            $table->string('color')->nullable();
            $table->string('weight')->nullable();
            $table->string('noise_grade')->nullable();
            $table->string('operating_temperature')->nullable();
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
        Schema::dropIfExists('core_data');
    }
}
