<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavedTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saved_todos', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default(' ');
            $table->boolean('completed')->default(false);
            $table->integer('userId')->default(0);
            $table->integer('priority')->default('1');
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
        Schema::dropIfExists('saved_todos');
    }
}
