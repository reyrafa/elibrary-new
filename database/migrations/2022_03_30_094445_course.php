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
        Schema::create('courses', function(Blueprint $table){   
            $table->id();
            $table->integer('college_id');
            $table->string('course');
        });
        DB::table('courses')->insert(array(
            ['id'=>'1', 'college_id'=>'1','course'=> 'Bachelor of Science in Information Technology'],
            ['id'=>'2', 'college_id'=>'1', 'course'=> 'Bachelor of Science in Entertainment and Multimedia Computing   major in Digital Animation'],
            ['id'=>'3', 'college_id'=>'1', 'course'=> 'Bachelor of Science in Automotive Technology'],
            ['id'=>'4', 'college_id'=>'1', 'course'=> 'Bachelor of Science in Electronics Technology'],
            ['id'=>'5', 'college_id'=>'1', 'course'=> 'Bachelor of Science in Food Technology'],
            ['id'=>'6', 'college_id'=>'2','course'=>  'Bachelor of Science in Hospitality Management'],
            ['id'=>'7', 'college_id'=>'2','course'=>  'Bachelor of Science in Business Administration'],
            ['id'=>'8', 'college_id'=>'2','course'=>  'Bachelor of Science in Accountancy'],          
            ['id'=>'9', 'college_id'=>'3','course'=>  'Bachelor of Science in Nursing'],
            ['id'=>'10', 'college_id'=>'4','course'=> 'Bachelor of Science in Law'],
            ['id'=>'11', 'college_id'=>'5','course'=> 'Bachelor of Science in Physical Education major in Schools Physical Education'],
            ['id'=>'12', 'college_id'=>'5','course'=> 'Bachelor of Science in Secondary Education'],
            ['id'=>'13', 'college_id'=>'5','course'=> 'Bachelor of Science in Elementary Education'],
            ['id'=>'14', 'college_id'=>'5','course'=> 'Bachelor of Science in Childhood Education'],
            ['id'=>'15', 'college_id'=>'6','course'=> 'Bachelor of Science in Biology Major in Biotechnology'],
            ['id'=>'16', 'college_id'=>'6','course'=> 'Bachelor of Science in Environmental Science Major in Environmental Heritage Studies'],
            ['id'=>'17', 'college_id'=>'6','course'=> 'Bachelor of Science in English Laguage'],
            ['id'=>'18', 'college_id'=>'6','course'=> 'Bachelor of Science in Economics'],
            ['id'=>'19', 'college_id'=>'6','course'=> 'Bachelor of Science in Sociology'],
            ['id'=>'20', 'college_id'=>'6','course'=> 'Bachelor of Science in Philosophy'],
            ['id'=>'21', 'college_id'=>'6','course'=> 'Bachelor of Science in Social Science'],
            ['id'=>'22', 'college_id'=>'6','course'=> 'Bachelor of Science Mathematics'],
            ['id'=>'23', 'college_id'=>'6','course'=> 'Bachelor of Science in Community Development'],
            ['id'=>'24', 'college_id'=>'6','course'=> 'Bachelor of Science in Development Communication'],
            ['id'=>'25', 'college_id'=>'7','course'=> 'Bachelor Public Administration Major in Local Governance'],
                  ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
