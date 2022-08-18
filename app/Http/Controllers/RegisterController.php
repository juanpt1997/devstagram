<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // ? dd('Post...'); // Helper
        // dd($request->get('email'));

        // Modificar el Request
        // ? Esto se hace en caso para que verifique el username convertido con slug no se encuentre repetido, 
        // ? de esta forma lo reescribimos antes de la validación, NO es muy recomendable
        $request->request->add(['username' => Str::slug($request->username)]); 

        // Validación
        $this->validate($request, [
            /* 'name' => 'required|min:5', */
            'name' => ['required','max:30'],
            'username' => ['required', 'unique:users', 'min:3', 'max:20'],
            'email' => ['required', 'unique:users', 'email', 'max:60'],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        User::create([
            'name' => $request->name,
            // 'username' => Str::slug($request->username), // ? slug lo convierte a una url, Str es una clase de los helpers de laravel
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Autenticar un usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);
        // Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        // Redireccionar al usuario
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
