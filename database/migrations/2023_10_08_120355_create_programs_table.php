<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();


            $table->unsignedBigInteger('created_by');
            // $table->foreign('created_by')
            // ->references('id')->on('users')->onDelete('set null');

            $table->unsignedBigInteger('updated_by')->nullable();
            // $table->foreign('updated_by')
            //     ->references('id')->on('users')->onDelete('set null');


            $table->string('en_title');
            $table->string('da_title');
            $table->string('pa_title');

            $table->string('en_sub_title')->nullable();
            $table->string('da_sub_title')->nullable();
            $table->string('pa_sub_title')->nullable();

            $table->string('en_description')->nullable();
            $table->string('da_description')->nullable();
            $table->string('pa_description')->nullable();

            $table->string('start');
            $table->string('end');

            // $table->text('image')->nullable();
            $table->boolean('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
