<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTypeTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_type_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_type_id');
            $table->unsignedBigInteger('tag_id');
            $table->softDeletes();
            $table->timestamps();
//            $table->foreign('service_type_id')->references('id')->on('service_types')->onDelete('cascade');
//            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_type_tags');
    }
}
