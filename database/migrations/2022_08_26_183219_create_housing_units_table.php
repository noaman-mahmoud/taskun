<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('housing_units', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id')->index('property_id');
            $table->string('role', 191);
            $table->string('name', 191)->nullable();
            $table->integer('housing_type_id')->nullable()->index('housing_type_id');
            $table->string('tenant_name', 191);
            $table->string('contract_number', 191);
            $table->string('phone', 191);
            $table->string('whatsapp', 191);
            $table->date('contract_from_date');
            $table->date('contract_to_date');
            $table->string('duration_contract', 191);
            $table->string('rent', 191);
            $table->string('payment_system', 191)->nullable();
            $table->string('electricity_bill', 191)->nullable();
            $table->string('water_bill', 191)->nullable();
            $table->text('message')->nullable();
            $table->integer('number_messages')->nullable();
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
        Schema::dropIfExists('housing_units');
    }
}
