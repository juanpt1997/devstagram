<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /* ===================================================
       GUARDAR LIKE
    ===================================================*/
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

        // Retornar a la vista anterior
        return back();
    }

    /* ===================================================
       BORRAR LIKE
    ===================================================*/
    public function destroy(Request $request, Post $post)
    {
        // $post->likes()->where('user_id', $request->user()->id)->delete();
        // ? Otra alternativa
        $request->user()->likes()->where('post_id', $post->id)->delete();
        // ? Con la segunda opción tuvimos que agregar la relación de likes en el modelo User

        // Retornar a la vista anterior
        return back();
    }
}