<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('client_id')->unsigned()->index()->nullable();
            $table->integer('service_id')->unsigned()->index()->nullable();
            $table->integer('branches_id')->unsigned()->index()->nullable();
            $table->tinyInteger('evaluation')->default(2);
            $table->text('comment');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users') ->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients') ->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services') ->onDelete('cascade');
            $table->foreign('branches_id')->references('id')->on('branches') ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
