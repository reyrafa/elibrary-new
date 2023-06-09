<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibrarianDeletedCollection extends Model
{
    use HasFactory;
    protected $fillable =[
        'librarian_id',
        'collection_id'
    ];
    protected $table = 'librarian_deleted_collections';
}
