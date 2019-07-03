<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->string('nip');
            $table->string('regon')->nullable();
            $table->string('email')->nullable();
            $table->integer('phone')->nullable();
            $table->integer('phone_2')->nullable();
            $table->text('description', 1000)->nullable();
            $table->date('deleted_at')->nullable();

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
        Schema::dropIfExists('companies');
    }
}
