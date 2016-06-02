<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbTablesAndColumnsAndCategoriesTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_table_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('remark')->nullable();
            $table->timestamps();
        });

        Schema::create('db_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('name');
            $table->text('alias')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_hidden')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('db_columns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_id')->nullable()->index();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('default')->nullable();
            $table->string('key')->nullable();
            $table->boolean('is_nullable');
            $table->string('extra')->nullable();
            $table->string('comment')->nullable();
            $table->string('alias')->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('db_table_categories');
        Schema::dropIfExists('db_tables');
        Schema::dropIfExists('db_columns');
    }
}
