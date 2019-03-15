<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->text('details');
            $table->decimal('price', 10, 3)->default(1);
            $table->string('currency')->default('egp');
            $table->enum('status', [0, 1])->default(1)->comment('0 => Not Acive, 1 => Active');
            $table->timestamps();

            $table->integer('client_id')->unsigned()->index();
            $table->foreign('client_id')->references('id')->on('clients') ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
