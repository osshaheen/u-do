<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('point_type_id');
            $table->unsignedBigInteger('style_id')->nullable();
            $table->string('name')->unique();
            $table->text('description');
            $table->integer('price');
            $table->softDeletes();
            $table->timestamps();
//            $table->foreign('point_type_id')->references('id')->on('point_types')->onDelete('cascade');
//            $table->foreign('style_id')->references('id')->on('style_id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_types');
    }
}
