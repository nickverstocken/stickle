<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->increments('child_id');
            $table->string('firstName');
            $table->string('lastName');
            $table->enum('gender',['male','female'])->default('male');
            $table->date('dateOfBirth');
            $table->string('picturePath')->nullable();
            $table->integer('rewardPoints')->default(0);
            $table->integer('coins')->default(0);
            $table->integer('parent_id')->unsigned();
            $table->boolean('logged_in')->default(0);
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')
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
        Schema::dropIfExists('children');
    }
}
