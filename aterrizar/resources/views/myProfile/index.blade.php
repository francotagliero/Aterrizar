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
                     @if(Auth::user()->hasRole('user'))
                    <th>Puntos</th>
                    @endif
                    @if(Auth::user()->hasRole('comercial'))
                    <th>DNI</th>
                    <th>Usuario</th>
                    @endif
                    @if(Auth::user()->hasRole('admin'))
                    <th>DNI</th>
                    <th>Usuario</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->lastname }}</a></td>
                    <td>{{ $user->email }}</td>
                     @if(Auth::user()->hasRole('user'))
                    <td>{{ $user->points }}</td>
                    @endif
                    @if(Auth::user()->hasRole('comercial'))
                    <td>{{ $user->dni }}</td>                        
                    <td>{{ $user->username }}</td>
                    @endif
                    @if(Auth::user()->hasRole('admin'))
                    <td>{{ $user->dni }}</td>                        
                    <td>{{ $user->username }}</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
