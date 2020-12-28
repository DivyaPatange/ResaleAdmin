<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function ($table) {
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
        });
        Schema::table('models', function ($table) {
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
        });
        Schema::table('types', function ($table) {
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands', function ($table) {
            $table->dropColumn('category_id');
        });
        Schema::table('models', function ($table) {
            $table->dropColumn('category_id');
        });
        Schema::table('types', function ($table) {
            $table->dropColumn('category_id');
        });
    }
}
