<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('client_id')->nullable()->unsigned()->index();
            $table->integer('service_id')->nullable()->unsigned()->index();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients') ->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services') ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}
