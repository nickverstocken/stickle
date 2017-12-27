<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stickers', function (Blueprint $table) {
            $table->increments('sticker_id');
            $table->string('uniqueCode')->nullable();
            $table->boolean('isAlreadyScanned');
            $table->integer('stickerBook_id')->unsigned();
            $table->timestamps();

            $table->foreign('stickerBook_id')->references('stickerBook_id')
            ->on('stickerBooks')
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
        Schema::dropIfExists('stickers');
    }
}
