<?php

namespace App\Http\Controllers;

use App\Models\Librarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Redirects extends Controller
{
    public function index(){
        $librarian = Librarian::all()->where('librarian_id', Auth::user()->id);

        foreach($librarian as $librarian_info){
            if($librarian_info->role_id == '1'){
                return redirect('/dashboard/user');
            }
            else if($librarian_info->role_id == '2'){
                return redirect('/dashboard/user');
            }
        }
    }
}
