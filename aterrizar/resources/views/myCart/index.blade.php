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
                    <td> <a class="btn btn-outline-primary" href="{{ URL('/completeTransaction/'.$transaction->id )}}" role="button">Comprar</a>
                         <a class="btn btn-outline-danger" href="#" role="button">Eliminar</a>
                      </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
