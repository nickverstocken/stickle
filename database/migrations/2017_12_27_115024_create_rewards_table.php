<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->increments('reward_id');
            $table->string('kind');
            $table->string('link')->nullable();
            $table->string('title');
            $table->time('timeToPlay')->nullable();
            $table->float('price');
            $table->string('picturePath')->nullable();
            $table->integer('customForChild_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('customForChild_id')->references('child_id')
            ->on('children')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewards');
    }
}
