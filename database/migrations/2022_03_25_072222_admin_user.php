<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
                'id' => 1,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'scope' => 'librarian',
                'status_id' => '1', 
                'created_at' => now(),
                'updated_at' => now(),
            )
        );
        DB::table('librarians')->insert(
            array(
                'id' => 1,
                'librarian_id' => '1',
                'id_number' => '89658',
                'firstname' => 'Yves',
                'lastname' => 'Estrada', 
                'middlename' => '',
                'role_id' => '1',
                'org_id'=> '1',
                'created_at' => now(),
                'updated_at' => now(),
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
};
