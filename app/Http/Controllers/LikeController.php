<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // Almacenar
        // Like::create([
        //     'user_id' => $request->user()->id,
        //     'post_id' => $post->id
        // ]);
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        // Imprimir un mensaje
        return back();
    }
}
