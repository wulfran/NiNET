<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('address_id');
            $table->foreign('company_id', 'ibfk_company_addresses_1')->references('id')->on('companies');
            $table->foreign('address_id', 'ibfk_company_addresses_2')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies_addresses');
    }
}
