<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenReadingBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childrenReadingBooks', function (Blueprint $table) {
            $table->increments('childrenReadingBook_id');
            $table->integer('child_id')->unsigned();
            $table->integer('book_id')->unsigned();
            $table->boolean('currentlyReading')->default(false);
            $table->boolean('isFinished')->default(false);
            $table->integer('lastPageRead')->default(0);
            $table->timestamps();

            $table->foreign('child_id')->references('child_id')
            ->on('children')
            ->onDelete('cascade');

            $table->foreign('book_id')->references('readingBook_id')
            ->on('readingBooks')
            ->onDelete('cascade');
            $table->unique(['child_id', 'book_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('childrenReadingBooks');
    }
}
