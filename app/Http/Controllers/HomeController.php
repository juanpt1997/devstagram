<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        // Obtener a quienes seguimos
        // pluck sirve para obtener ciertos campos
        // toArray convierte a un arreglo
        dd(auth()->user()->following->pluck('id')->toArray());

        return view('home');
    }
}
