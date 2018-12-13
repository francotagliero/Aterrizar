@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>Mi Carrito</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Servicio</th>
                    <th>Información</th>
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
                    @switch($transaction->service->service_type)
                        @case('Flight')
                            <td>Vuelo</td>
                            <td><a href="{!! route('flights.show', $transaction->service_id) !!}">
                            {{ $transaction->service->from->name }} &gt; {{ $transaction->service->to->name }}
                            </a>
                            @if ($transaction->detail->stop !== null)
                            <br>
                            <a href="{!! route('flights.show', $transaction->detail->stop->id) !!}">
                            {{ $transaction->detail->stop->from->name }} &gt; {{ $transaction->detail->stop->to->name }}
                            </a>
                            @endif
                            </td>
                            @break
                        @case('Car')
                            <td>Auto</td>
                            <td>Detalles del auto</td>
                            @break
                         @case('Room')
                            <td>Habitación</td>
                            <td>Detalles de la habitación</td>
                    @endswitch
                    <td>{{ $transaction->points }}</td>
                    <td>{{ $transaction->points_given ? 'Sí' : 'No' }}</td>
                    <td>{{ number_format($transaction->price, 2, ',', '') }}</td>
                    <td> <a class="btn btn-outline-primary" href="{{ URL('/completeTransaction/'.$transaction->id )}}" role="button">Comprar</a>
                         <a class="btn btn-outline-danger" href="{!!route('transactions.removefromcart', $transaction->id) !!}" role="button">Eliminar</a>
                      </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
