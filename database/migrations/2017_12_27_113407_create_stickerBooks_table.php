<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStickerBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stickerBooks', function (Blueprint $table) {
            $table->increments('stickerBook_id');
            $table->string('uniqueCode')->nullable();
            $table->integer('numberOfStickers');
            $table->boolean('isPairedToChild')->default(0);
            $table->integer('child_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('child_id')->references('child_id')
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
        Schema::dropIfExists('stickerBooks');
    }
}
