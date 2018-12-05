@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
         <h1> Mi Perfil </h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Puntos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->lastname }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->points }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
