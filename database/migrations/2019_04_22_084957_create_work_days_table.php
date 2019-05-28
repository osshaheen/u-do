<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('calendar_id');
            $table->unsignedBigInteger('week_day_id');
            $table->integer('max_number')->nullable();
            $table->time('from')->nullable();
            $table->time('to')->nullable();
            $table->softDeletes();
            $table->timestamps();
//            $table->foreign('calendar_id')->references('id')->on('calendars')->onDelete('cascade');
//            $table->foreign('week_day_id')->references('id')->on('week_days')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('week_days');
    }
}
