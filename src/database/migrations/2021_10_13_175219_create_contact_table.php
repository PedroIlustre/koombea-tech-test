<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('upload_id')->unsigned();
            $table->string('name');
            $table->string('birth_date');
            $table->string('phone');
            $table->string('addres');
            $table->string('credit_card');
            $table->string('franchise');
            $table->string('email');
            $table->timestamps();
        });

        Schema::table('contacts', function ($table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('upload_id')
                ->references('id')
                ->on('uploads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
