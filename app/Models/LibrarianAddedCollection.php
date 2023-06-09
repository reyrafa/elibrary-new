<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibrarianAddedCollection extends Model
{
    use HasFactory;
    protected $fillable =[
        'librarian_id',
        'collection_id',
    ];
    protected $table = 'librarian_added_collections';
}
