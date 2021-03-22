<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedInteger('sub_category_id');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types');
            $table->string('size');
            $table->boolean('status');
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
        Schema::dropIfExists('sizes');
    }
}
