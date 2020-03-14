<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->integer('is_admin')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->string('avatar')->nullable();
            $table->text('balans')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
