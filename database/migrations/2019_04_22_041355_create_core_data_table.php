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
            $table->string('suitability')->nullable();

            $table->string('com_protocol')->nullable();
            $table->string('display_type')->nullable();
            $table->string('display')->nullable();
            $table->string('support_modes')->nullable();
            $table->string('nominal_capacity')->nullable();
            $table->string('resolution')->nullable();
            $table->string('input_voltage')->nullable();
            $table->string('output_voltage')->nullable();
            $table->string('type')->nullable();
            $table->string('signals')->nullable();
            $table->string('current_limit')->nullable();
            $table->string('low_voltage_protection')->nullable();
            $table->string('wire_specification')->nullable();
            $table->string('teeth_number')->nullable();
            $table->string('chain_line')->nullable();
            $table->string('thickness')->nullable();
            $table->string('chain_wheel_material')->nullable();
            $table->string('frame_materail')->nullable();
            $table->string('cover_material')->nullable();
            $table->string('energy_content')->nullable();
            $table->string('e_brake')->nullable();
            $table->string('gearsensor_function')->nullable();
            $table->string('light_drive_capacity')->nullable();

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
