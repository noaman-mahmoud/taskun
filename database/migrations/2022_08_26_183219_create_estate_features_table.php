<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estate_features', function (Blueprint $table) {
            $table->id();
            $table->integer('estate_id')->index('estate_id');
            $table->integer('feature_id')->index('feature_id');
            $table->string('type', 191)->nullable();
            $table->string('value', 191)->nullable();
            $table->integer('option_id')->nullable()->index('option_id');
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
        Schema::dropIfExists('estate_features');
    }
}
