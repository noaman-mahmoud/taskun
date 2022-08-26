<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->unique();
            $table->unsignedInteger('city_id')->nullable()->index('city_id');
            $table->string('lat', 191)->nullable();
            $table->string('lng', 191)->nullable();
            $table->string('address', 191)->nullable();
            $table->string('password');
            $table->string('avatar', 50)->default('default.png');
            $table->string('user_type', 191)->default('owner - office - marketer');
            $table->text('jwt_token')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('block')->default(false);
            $table->string('lang', 2)->default('ar');
            $table->boolean('is_notify')->default(true);
            $table->string('code', 10)->nullable();
            $table->dateTime('code_expire')->nullable();
            $table->integer('activation_admin')->nullable()->default(1);
            $table->string('uuid', 191)->nullable();
            $table->string('qr', 191)->nullable();
            $table->integer('views')->default(0);
            $table->string('whatsapp', 191)->nullable();
            $table->string('commercial', 191)->nullable();
            $table->string('advertiser_number', 191)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
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
