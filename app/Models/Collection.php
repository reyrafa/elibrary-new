<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $table ='collections';
    protected $fillable =[
        'title',
        'author',
        'isbn',
        'call_number',
        'page_num',
        'location_id',
        'section_id',
        'date_publish',
        'subject_id',
        'permission_id',
        'filelink',
        'collection_status'
    ];
}
