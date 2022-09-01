<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        // Obtener a quienes seguimos
        // pluck sirve para obtener ciertos campos
        // toArray convierte a un arreglo
        $ids = auth()->user()->following->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->paginate(20);

        return view('home', [
            'posts' => $posts
        ]);
    }
}
