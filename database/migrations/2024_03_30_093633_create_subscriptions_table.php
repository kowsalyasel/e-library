<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('book_id');
            $table->string('user_id');
            $table->date('subscription_date');
            $table->date('due_date');
            $table->string('subscribe_id')->nullable();
            $table->timestamps();
            $table->date('return_date')->nullable();

            // Foreign keys
            $table->foreign('book_id')->references('book_id')->on('books')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
