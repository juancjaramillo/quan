<!-- resources/views/users/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edición de Usuario</h1>
    <!-- Agrega aquí el formulario de edición -->
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" required>
        </div>
        <div>
            <label for="password">Nueva Contraseña:</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <button type="submit">Guardar Cambios</button>
        </div>
    </form>
@endsection
