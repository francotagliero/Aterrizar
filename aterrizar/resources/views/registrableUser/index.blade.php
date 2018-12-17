@extends('layouts.app')

@section('content')
<div class="container">
    @include('common.title', ['title' => 'Usuarios con registro parcial'])
    <div class="row justify-content-center">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Alta</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrableUser as $registrable_user)
                <tr>
                    <td>{{ $registrable_user->email }}</td>
                    <td>{{ $registrable_user->role->description }}</td>
                    <td>{{ $registrable_user->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
