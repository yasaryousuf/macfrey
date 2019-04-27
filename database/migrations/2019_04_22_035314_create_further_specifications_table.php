<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFurtherSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('further_specifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('component_id');
            $table->string('speed_detection_signal')->nullable();
            $table->string('reduction_ratio')->nullable();
            $table->string('magnet_poles')->nullable();

            $table->string('bluetooth')->nullable();
            $table->string('usb_charge')->nullable();
            $table->string('usb_communication')->nullable();
            $table->string('number_of_cells')->nullable();
            $table->string('lighting_output_voltage')->nullable();
            $table->string('walk_assistance')->nullable();
            $table->string('speed_limit')->nullable();
            $table->string('gearshift')->nullable();
            $table->string('charging_time')->nullable();
            $table->string('charging_cycles')->nullable();
            $table->string('throttle_voltage_input')->nullable();
            $table->string('pas_mode')->nullable();
            $table->string('pin_surface_treatment')->nullable();
            $table->string('minimum_distance')->nullable();
            $table->string('maximum_distance')->nullable();
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
        Schema::dropIfExists('further_specifications');
    }
}
