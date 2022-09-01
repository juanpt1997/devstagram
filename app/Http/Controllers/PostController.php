<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
        // Con este middleware evitamos que un usuario no autenticado acceda al resto del controlador
    }

    public function index(User $user) // ? Route model binding
    {
        // $posts = Post::where('user_id', $user->id)->get(); // ? También sirve pero podemos usar la relación creada
        // $posts = $user->posts()->get(); // ? así retorno todo
        $posts = $user->posts()->latest()->paginate(4); // Así pagino

        // ? También se puede consultar los posts directo en la vista con el usuario

        return view(
            'dashboard',
            [
                'user' => $user,
                'posts' => $posts
            ]
        );
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'description' => 'required',
            'imagen' => 'required'
        ]);

        // ? Forma inicial
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->description,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        // ? Otra forma
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->description;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        // ? Tercer forma después de haber creado las relaciones en los modelos
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->description,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view(
            'posts.show',
            ['post' => $post]
        );
    }

    public function destroy(Post $post)
    {
        // if ($post->user_id === auth()->user()->id){
        //     dd('Misma persona');
        // }
        // ? Debido a PostPolicy solo con la línea de abajo hago lo mismo que arriba
        $this->authorize('delete', $post);
        $post->delete();

        // Eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        if (File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
