@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('common.title', ['title' => 'Mis Compras'])
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>id</th>
                    <th>Servicio</th>
                    <th>Id del Servicio</th>
                    <th>Puntos</th>
                    <th>Puntos Asignados</th>
                    <th>Precio</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->service_name }}</td>
                    <td>{{ $transaction->service_id}}</td>
                    <td>{{ $transaction->points }}</td>
                    <td>{{ $transaction->points_given }}</td>
                    <td>{{ number_format($transaction->price, 2, ',', '') }}</td>
                    <td>{{ $transaction->status }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
