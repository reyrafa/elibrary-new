<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('collections', function(Blueprint $table){
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->bigInteger('isbn');
            $table->integer('call_number');
            $table->integer('page_num');
            $table->integer('location_id');
            $table->integer('section_id');
            $table->date('date_publish');
            $table->string('firebase_key');
            $table->integer('subject_id');
            $table->integer('permission_id');
            $table->text('filelink');
            $table->integer('collection_status');
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
        Schema::dropIfExists('collections');
    }
};
