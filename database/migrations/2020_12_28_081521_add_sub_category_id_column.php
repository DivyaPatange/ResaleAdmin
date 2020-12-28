<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubCategoryIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function ($table) {
            $table->unsignedInteger('sub_category_id');
            $table->foreign('sub_category_id')->references('id')->on('subcategories');
        });
        Schema::table('models', function ($table) {
            $table->unsignedInteger('sub_category_id');
            $table->foreign('sub_category_id')->references('id')->on('subcategories');
        });
        Schema::table('types', function ($table) {
            $table->unsignedInteger('sub_category_id');
            $table->foreign('sub_category_id')->references('id')->on('subcategories');
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
            $table->dropColumn('sub_category_id');
        });
        Schema::table('models', function ($table) {
            $table->dropColumn('sub_category_id');
        });
        Schema::table('types', function ($table) {
            $table->dropColumn('sub_category_id');
        });
    }
}
