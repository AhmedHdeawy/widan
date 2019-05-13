<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('client_id')->unsigned()->index()->nullable();
            $table->foreign('client_id')->references('id')->on('clients') ->onDelete('cascade');

            $table->integer('branch_id')->unsigned()->index()->nullable();
            $table->foreign('branch_id')->references('id')->on('branches') ->onDelete('cascade');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users') ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
