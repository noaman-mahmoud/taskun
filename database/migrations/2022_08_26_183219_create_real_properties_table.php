<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->string('name', 191);
            $table->integer('estate_type_id')->nullable()->index('estate_type_id');
            $table->integer('housing_type_id')->nullable()->index('housing_type_id');
            $table->string('address', 191);
            $table->string('lat', 191);
            $table->string('lng', 191);
            $table->integer('number_roles')->default(1);
            $table->string('image', 191)->nullable();
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
        Schema::dropIfExists('real_properties');
    }
}
