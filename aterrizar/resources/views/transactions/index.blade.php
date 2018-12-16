@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>Transacciones</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Servicio</th>
                    <th>Información del Servicio</th>
                    <th>Usuario</th>
                    <th>Puntos</th>
                    <th>Puntos Asignados</th>
                    <th>Precio</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->service_id }}</td>
                    <td>@include('common.service_type', ['transaction' => $transaction])</td>
                    <td> @include('common.service_information', ['transaction' => $transaction])</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ $transaction->points }}</td>
                    <td>{{ $transaction->points_given ? 'Sí' : 'No' }}</td>
                    <td>{{ number_format($transaction->price, 2, ',', '') }}</td>
                    <td>{{ $transaction->status }}</td>
    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
