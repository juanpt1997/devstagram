<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
            'email' => ['required', 'unique:users,email,' . auth()->user()->id, 'email', 'max:60'],
        ]);

        if ($request->imagen) {
            // $input = $request->all();
            // Capturo el archivo del formulario
            $imagen = $request->file('imagen');
            // Nombre único
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            // La creo como tipo objeto de Image
            $imagenServidor = Image::make($imagen);
            // La vuelvo cuadrada
            $imagenServidor->fit(1000, 1000);
            // Ruta
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            // Guardo en la ruta
            $imagenServidor->save($imagenPath);
        }

        // Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        // Así verificamos si viene vacío y luego si ya tiene una imagen previa guardada para que no la borre editando solo el username
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null; 
        $usuario->save();

        // Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
