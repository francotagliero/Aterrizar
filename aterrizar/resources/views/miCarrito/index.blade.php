@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>Mi Carrito</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Servicio</th>
                    <th>Id del Servicio</th>
                    <th>Puntos</th>
                    <th>Puntos Asignados</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Accion</th>
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
                    <td> <button type="button" class="btn btn-outline-primary">Comprar</button>
                      <button type="button" class="btn btn-outline-danger">Eliminar</button> </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
