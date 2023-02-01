<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            Schema::create('tasks', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned()->nullable();
                $table->string('title', 100);
                $table->integer('status')->unsigned()->nullable();
                $table->timestamps();
                $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
                $table->foreign('status')
                ->references('id')
                ->on('statuses')
                ->nullOnDelete();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
