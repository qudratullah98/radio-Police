<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('en_nav_title');
            $table->string('da_nav_title');
            $table->string('pa_nav_title');
            $table->string('en_nav_subtitle');
            $table->string('da_nav_subtitle');
            $table->string('pa_nav_subtitle');
            $table->string('en_province');
            $table->string('da_province');
            $table->string('pa_province');
            $table->text('en_street');
            $table->text('da_street');
            $table->text('pa_street');
            $table->string('en_exact_address');
            $table->string('da_exact_address');
            $table->string('pa_exact_address');
            $table->text('en_about_us');
            $table->text('da_about_us');
            $table->text('pa_about_us');
            $table->text('map_location');
            $table->string('phone');
            $table->string('email');
            $table->text('tab_icon');
            $table->text('nav_logo');


            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
