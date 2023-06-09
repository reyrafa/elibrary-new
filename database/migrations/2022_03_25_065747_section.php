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
        Schema::create('sections', function(Blueprint $table){
            $table->id();
            $table->string('section_name');
        });
        DB::table('sections')->insert(array(
            ['id'=>'1', 'section_name'=>'Filipiniana'],
            ['id'=>'2', 'section_name'=>'General Circulation'],
            ['id'=>'3', 'section_name'=>'References'],
            ['id'=>'4', 'section_name'=>'Reserve'],
            ['id'=>'5', 'section_name'=>'Periodicals']
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
};
