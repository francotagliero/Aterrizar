@extends('layouts.app')

@section('content')
<div class="container">
    @include('common.title', ['title' => 'Transacciones'])
    <div class="row justify-content-center">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Servicio</th>
                    <th>Información del Servicio</th>
                    <th>Usuario</th>
                    <th>Puntos</th>
                    <th>Puntos Asignados</th>
                    <th class="text-sm-right">Precio</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>@include('common.service_type', ['transaction' => $transaction])</td>
                    <td>@include('common.service_information', ['transaction' => $transaction, 'no_links' => true ])</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ $transaction->points }}</td>
                    <td>{{ $transaction->points_given ? 'Sí' : 'No' }}</td>
                    <td class="text-sm-right">@include('common.price', ['price' => $transaction->price])</td>
                    <td>{{ $transaction->status }}</td>
    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
