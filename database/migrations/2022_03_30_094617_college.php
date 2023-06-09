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
        Schema::create('colleges', function(Blueprint $table){   
            $table->id();
            $table->string('college');
        });
        DB::table('colleges')->insert(array(
            ['id'=>'1', 'college'=>'College of Technologies'],
            ['id'=>'2', 'college'=>'College of Business'],
            ['id'=>'3', 'college'=>'College of Nursing'],
            ['id'=>'4', 'college'=>'College of Law'],
            ['id'=>'5', 'college'=>'College of Education'],
            ['id'=>'6', 'college'=>'College of Arts and Sciences'],
            ['id'=>'7', 'college'=>'College of Administration'],
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colleges');
    }
};
