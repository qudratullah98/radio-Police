<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayOfWeekProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_of_week_programs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('periority')->nullable();
            $table->unsignedBigInteger('program_id');
            // $table->foreign('program_id')
            // ->references('id')->on('programs')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('day_of_week_id');
            // $table->foreign('day_of_week_id')
            // ->references('id')->on('day_of_weeks')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('day_of_week_programs');
    }
}