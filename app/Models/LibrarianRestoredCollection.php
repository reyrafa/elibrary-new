<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibrarianRestoredCollection extends Model
{
    use HasFactory;
    protected $fillable = [
        'librarian_id',
        'collection_id'
    ];
    protected $table = 'librarian_restored_collections';
}
