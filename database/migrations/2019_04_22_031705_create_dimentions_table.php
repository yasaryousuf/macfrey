<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDimentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dimentions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('component_id');
            $table->string('image')->nullable();
            $table->string('A')->nullable();
            $table->string('B')->nullable();
            $table->string('C')->nullable();
            $table->string('D')->nullable();
            $table->string('E')->nullable();
            $table->string('F')->nullable();
            $table->string('G')->nullable();
            $table->string('H')->nullable();
            $table->string('I')->nullable();
            $table->string('J')->nullable();
            $table->string('K')->nullable();
            $table->string('wl')->nullable();
            $table->string('wr')->nullable();
            $table->string('old')->nullable();
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
        Schema::dropIfExists('dimentions');
    }
}
