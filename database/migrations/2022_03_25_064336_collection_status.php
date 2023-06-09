<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('collection_status', function(Blueprint $table){
            $table->id();
            $table->string('status');
        });
        DB::table('collection_status')->insert(array(
            ['id'=>'1', 'status'=>'added'],
            ['id'=>'2', 'status'=>'deleted'],
            ['id'=>'3', 'status'=>'restored']
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_status');
    }
};
