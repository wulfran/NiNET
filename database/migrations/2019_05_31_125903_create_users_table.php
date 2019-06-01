<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('account_type');
            $table->date('deleted_at')->nullable();
            $table->integer('address_id')->nullable()->foreign('address_id','users_ibfk_1')->references('id')->on('addresses')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->integer('phone')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->integer('company_id')->nullable()->foreign('company_id', 'users_ibfk_2')->references('id')->on('companies')->onUpdate('CASCADE')->onDelete('SET NULL');
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
