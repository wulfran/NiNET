<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSuperuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("INSERT INTO users(id, name, email, password, first_name, last_name, account_type) VALUES(1, 'superuser', 'super@user.su', '$2y$10$2LuIsLrgpIC/Nwp/Z30LcOqdkSGBt3ydw3nF3WzM7bCdXyhfYpkUe', 'super', 'user', 'superuser');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DELETE FROM users WHERE id=1;");
    }
}
