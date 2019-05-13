<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('slug');
            $table->text('description')->nullable();
            $table->text('address');
            $table->string('phone');
            $table->text('logo');
            $table->string('location');
            $table->decimal('rate', 2, 1);
            // 0 => Not Acive, 1 => Active, 2 => Stopped
            $table->enum('status', [0, 1, 2])->default(1)->comment('0 => Not Acive, 1 => Active, 2 => Stopped');
            $table->integer('client_id')->unsigned()->index();
            $table->integer('city_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients') ->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
