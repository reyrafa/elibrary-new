<?php

namespace App\Http\Middleware;

use App\Models\Librarian;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $librarian = Librarian::all()->where('librarian_id', Auth::user()->id);
       foreach($librarian as $librarian_info){
        if($librarian_info->role_id == "1"){
            return $next($request);
        }
    }
        return redirect('/');
    }
}
