<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readingBooks', function (Blueprint $table) {
            $table->increments('readingBook_id');
            $table->string('title');
            $table->string('coverPath')->nullable();
            $table->integer('numberOfPages');
            $table->string('author');
            $table->text('shortDescription')->nullable();
            $table->integer('addedBy_id')->unsigned();
            $table->timestamps();

            $table->foreign('addedBy_id')->references('id')
            ->on('users')
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
        Schema::dropIfExists('readingBooks');
    }
}
