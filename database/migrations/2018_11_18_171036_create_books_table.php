<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->softDeletes();

            $table->unsignedInteger('user_id')->index();

            $table->string('author');
            $table->string('title');
            $table->string('isbn');
            $table->string('publisher');
            $table->boolean('available');
            $table->string('code');
            $table->unsignedInteger('pages');
            $table->unsignedInteger('price');
            $table->string('language');
            $table->string('edition');
            $table->text('description');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('books');
    }
}
