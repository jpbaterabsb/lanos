<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert(
            array(
                'id' => '1',
                'name' => 'Joao Paulo',
                'email' => 'jpbaterabsb@gmail.com',
                'password' => '$2y$10$46MvP/LrSxjzIWKl2G5/qOAJ2N5KWvjPfV4HuOIjJUvgEI9nwlmTe',
                'nivel' => 'ADMIN',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
