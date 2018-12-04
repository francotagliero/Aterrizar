@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrableUser as $registrable_user)
                <tr>
                    <td>{{ $registrable_user->email }}</td>
                    <td>{{ $registrable_user->role->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
