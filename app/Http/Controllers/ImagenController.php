<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        // $input = $request->all();
        // Capturo el archivo del formulario
        $imagen = $request->file('file');
        // Nombre único
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        // La creo como tipo objeto de Image
        $imagenServidor = Image::make($imagen);
        // La vuelvo cuadrada
        $imagenServidor->fit(1000, 1000);
        // Ruta
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        // Guardo en la ruta
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
