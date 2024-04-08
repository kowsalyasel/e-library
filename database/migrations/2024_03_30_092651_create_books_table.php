<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('book_id')->unique();
            $table->string('title');
            $table->string('author');
            $table->string('ISBN')->nullable();
            $table->string('publisher');
            $table->date('publication_date');
            $table->string('category');
            $table->string('language');
            $table->integer('number_of_copies');
            $table->string('location');
            $table->string('edition')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->string('availability_status');
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
        Schema::dropIfExists('books');
    }
}

