<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMountingParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mounting_parameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('component_id');
            $table->string('brake')->nullable();
            $table->string('installation_widths')->nullable();
            $table->string('max_housing_diameter')->nullable();
            $table->string('cabling_route')->nullable();
            $table->string('cable_length')->nullable();
            $table->string('gearshift')->nullable();
            $table->string('spoke_specification')->nullable();

            $table->string('tire_specification')->nullable();
            $table->string('induction_distance')->nullable();
            $table->string('mounting_position')->nullable();
            $table->string('connector_size')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('com_protocol')->nullable();
            $table->string('e_brake_level')->nullable();
            $table->string('bb_width')->nullable();
            $table->string('holder')->nullable();

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
        Schema::dropIfExists('mounting_parameters');
    }
}
