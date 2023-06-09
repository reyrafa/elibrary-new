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
        Schema::create('subjects', function(Blueprint $table){
            $table->id();
            $table->string('subject_name');
        });
        DB::table('subjects')->insert(array(
            ['id'=>'1', 'subject_name'=>'Science'],
            ['id'=>'2', 'subject_name'=>'Filipino'],
            ['id'=>'3', 'subject_name'=>'Mathemathics'],
            ['id'=>'4', 'subject_name'=>'Social Science'],
            ['id'=>'5', 'subject_name'=>'Biology'],
            ['id'=>'6', 'subject_name'=>'Technology'],
            ['id'=>'7', 'subject_name'=>'English Literature'],
            ['id'=>'8', 'subject_name'=>'History'],
            ['id'=>'9', 'subject_name'=>'Environmental Science'],
            ['id'=>'10', 'subject_name'=>'Education'],
            ['id'=>'11', 'subject_name'=>'Sociology'],
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
};
