<?php

// app/Http/Controllers/API/UserController.php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }



public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ], [
        'email.unique' => 'Este correo electronico ya esta en uso.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres..',
        'password.confirmed' => 'La confirmación de la contraseña no coincide.',
    ]);

    // Crear el usuario
    User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
    ]);

    // Redirigir dependiendo de si hay errores o no
    if ($request->session()->has('errors')) {
        return redirect('/#register')->withErrors($request->session()->get('errors'))->withInput();
    } else {
        return redirect('/#login');
    }

}



    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->update($validatedData);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }


    public function create()
    {
        return view('users.create');
    }




    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/users'); // Cambia la ruta según tus necesidades
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }



}
