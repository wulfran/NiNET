<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id');
            $table->string('name');
            $table->double('price_netto');
            $table->double('price_vat')->nullable();
            $table->double('price_brutto');
            $table->integer('quantity');
            $table->string('unit')->default('szt');
            $table->double('value_netto');
            $table->double('value_vat');
            $table->double('value_brutto');
            $table->integer('vat_percentage')->nullable();
            $table->timestamps();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_positions');
    }
}
