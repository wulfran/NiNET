<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->integer('seller_id')
                ->nullable()
                ->foreign('seller_id', 'invoices_ibkf_1')
                ->references('id')
                ->on('companies')
                ->onDelete('set null');
            $table->integer('buyer_id')
                ->nullable()
                ->foreign('buyer_id')
                ->references('id')
                ->on('companies')
                ->onDelete('set null')
                ;
            $table->double('value_netto');
            $table->double('value_vat')->nullable();
            $table->integer('vat_percentage')->nullable();
            $table->double('value_brutto');
            $table->boolean('is_paid')->default(false);
            $table->date('sold_at');
            $table->date('payment_date');
            $table->string('bank_account')->nullable();
            $table->string('payment_method')->nullable();
            $table->text('comments')->nullable();
            $table->date('deleted_at')->nullable();
            $table->boolean('archive')->default(false);
            $table->string('issued_by')->nullable();
            $table->string('place')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
