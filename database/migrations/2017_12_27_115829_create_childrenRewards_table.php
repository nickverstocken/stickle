<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childrenRewards', function (Blueprint $table) {
            $table->increments('childrenReward_id');
            $table->integer('child_id')->unsigned();
            $table->integer('reward_id')->unsigned();
            $table->boolean('rewardIsBought')->nullable();
            $table->timestamps();

            $table->foreign('child_id')->references('child_id')
            ->on('children')
            ->onDelete('cascade');

            $table->foreign('reward_id')->references('reward_id')
            ->on('rewards')
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
        Schema::dropIfExists('childrenRewards');
    }
}
