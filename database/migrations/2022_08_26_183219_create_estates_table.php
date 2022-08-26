<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references( 'id' )->on( 'users' )->onDelete( 'cascade');

            $table->unsignedInteger('city_id')->nullable()->index('city_id');
            $table->string('user_type', 191);
            $table->string('type', 11)->default('sell')->comment('sell or rent');
            $table->string('address', 191);
            $table->string('lat', 191);
            $table->string('lng', 191);
            $table->unsignedBigInteger('category_id')->index('category_id');
            $table->foreign('category_id')->references( 'id' )->on( 'categories' )->onDelete( 'cascade');

            $table->string('title', 191);
            $table->unsignedBigInteger('estate_category_id')->index('estate_category_id');
            $table->foreign('estate_category_id')->references( 'id' )->on( 'estate_categories' )->onDelete( 'cascade');

            $table->string('sale_type', 191)->nullable()->comment('som , limit');
            $table->string('entrustment', 191)->nullable();
            $table->string('price', 191)->nullable();
            $table->string('neighborhood', 191)->nullable();
            $table->string('planned', 191)->nullable();
            $table->text('description')->nullable();
            $table->string('whatsapp', 191)->nullable();
            $table->string('username', 191)->nullable();
            $table->string('user_whatsapp', 191)->nullable();
            $table->string('user_phone', 191)->nullable();
            $table->integer('publish')->default(0);
            $table->integer('views')->default(0);
            $table->integer('archive')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estates');
    }
}
