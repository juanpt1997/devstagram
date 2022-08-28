<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user)
    {
        // ? Se recomienda attach en vez de create por lo que es una tabla pivote (muchos a muchos)
        // Ambas llaves foráneas son de la misma tabla users
        //$user->followers => Accedo a la información
        //$user->followers() => Accedo al método
        $user->followers()->attach(auth()->user()->id);

        return back();
    }


    public function destroy(User $user)
    {
        $user->followers()->detach(auth()->user()->id);

        return back();
    }
}
