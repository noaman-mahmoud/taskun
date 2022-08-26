<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_updates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['password', 'phone', 'email'])->nullable()->default('password');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('code')->nullable();
            $table->string('newPhoneCode')->nullable();
            $table->unsignedBigInteger('user_id')->index();
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
        Schema::dropIfExists('user_updates');
    }
}
