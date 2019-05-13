<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table to store Business Profile
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('slug');
            $table->text('description');
            $table->text('address');
            $table->string('phone');
            $table->text('logo');
            $table->string('location');
            $table->decimal('rate', 2, 1);
            // 0 => Not Acive, 1 => Active, 2 => Stopped
            $table->enum('status', [0, 1, 2])->default(1)->comment('0 => Not Acive, 1 => Active, 2 => Stopped');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('city_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users') ->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities') ->onDelete('cascade');

        });

        // Create table to store clients Likes
        // Schema::create('likes', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->text('body')->nullable();
        //     $table->text('images')->nullable();
        //     // 0 => None, 1 => Like, 2 => Dislike
        //     // $table->enum('status', [0, 1, 2])->default(0)->comment('0 => None, 1 => Like, 2 => Dislike');
        //
        //     $table->integer('client_id')->nullable()->unsigned()->index();
        //     $table->foreign('client_id')->references('id')->on('clients') ->onDelete('cascade');
        //
        //     $table->integer('service_id')->nullable()->unsigned()->index();
        //     $table->foreign('service_id')->references('id')->on('services') ->onDelete('cascade');
        //
        //     $table->integer('user_id')->unsigned()->index();
        //     $table->foreign('user_id')->references('id')->on('users') ->onDelete('cascade');
        //
        //     $table->timestamps();
        // });

        // Create table to store clients Likes
        // Schema::create('dislikes', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->text('body')->nullable();
        //     $table->text('images')->nullable();
        //     // 0 => None, 1 => Like, 2 => Dislike
        //     // $table->enum('status', [0, 1, 2])->default(0)->comment('0 => None, 1 => Like, 2 => Dislike');
        //
        //     $table->integer('client_id')->nullable()->unsigned()->index();
        //     $table->foreign('client_id')->references('id')->on('clients') ->onDelete('cascade');
        //
        //     $table->integer('service_id')->nullable()->unsigned()->index();
        //     $table->foreign('service_id')->references('id')->on('services') ->onDelete('cascade');
        //
        //     $table->integer('user_id')->unsigned()->index();
        //     $table->foreign('user_id')->references('id')->on('users') ->onDelete('cascade');
        //
        //     $table->timestamps();
        // });


        // Make a relation many-to-many  [ clients -> categories ]
        Schema::create('client_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('client_id')->unsigned()->index();
            $table->foreign('client_id')->references('id')->on('clients') ->onDelete('cascade');

            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories') ->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
        // Schema::dropIfExists('likes');
        // Schema::dropIfExists('dislikes');
        Schema::dropIfExists('client_categories');
    }
}
