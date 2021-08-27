<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('model')->comment('имя таблицы модели')->nullable();
            $table->string('name')->comment('имя файла')->nullable();
            $table->string('format')->comment('расширение файла')->nullable();
            $table->integer('size')->comment('размер файла')->nullable();
            $table->integer('model_id')->comment('айди модели для которой сохраняется файл')->nullable();
            $table->string('target')->comment('назначение, это могут быть документы, картинки и тд.')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medias');
    }
}
