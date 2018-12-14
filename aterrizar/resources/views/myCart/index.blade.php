@extends('layouts.app')

@section('content')
<div class="container">
    @include('common.title', ['title' => 'Mi Carrito'])
    <div class="row justify-content-center">
        <div class="col-sm-12">
            @if ($transactions->isNotEmpty())
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Servicio</th>
                        <th>Información</th>
                        <th class="text-sm-right">Precio</th>
                        <th></th>
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
                                ({{ Carbon\Carbon::parse($transaction->service->date)->format('d-m-Y') }})
                                @if ($transaction->detail->stop !== null)
                                <br>
                                <a href="{!! route('flights.show', $transaction->detail->stop->id) !!}">
                                {{ $transaction->detail->stop->from->name }} &gt; {{ $transaction->detail->stop->to->name }}
                                </a>
                                ({{ Carbon\Carbon::parse($transaction->detail->stop->date)->format('d-m-Y') }})
                                @endif
                                <br>
                                @switch($transaction->detail->class)
                                    @case('Economy')
                                    Clase Económica
                                    @break
                                    @case('Business')
                                    Clase Ejecutiva
                                    @break
                                    @case('First')
                                    Primera Clase
                                @endswitch
                                </td>
                                @break
                            @case('Car')
                                <td>Auto</td>
                                <td><a href="{!! route('cars.show', $transaction->service_id) !!}">
                                {{ $transaction->service->brand->name }} {{ $transaction->service->model }}
                                </a>
                                <br>
                                {{ $transaction->service->agency->name }}
                                <br>
                                Del {{ Carbon\Carbon::parse($transaction->service->from)->format('d-m-Y') }} al {{ Carbon\Carbon::parse($transaction->service->to)->format('d-m-Y') }}
                                </td>
                                @break
                            @case('Room')
                                <td>Habitación</td>
                                <td><a href="{!! route('rooms.show', $transaction->service_id) !!}">
                                Hotel {{ $transaction->service->hotel->name }} 
                                </a>
                                ({{ $transaction->service->capacity }} personas)
                                <br>
                                Del {{ Carbon\Carbon::parse($transaction->service->from)->format('d-m-Y') }} al {{ Carbon\Carbon::parse($transaction->service->to)->format('d-m-Y') }}
                                </td>
                        @endswitch
                        <td class="text-sm-right">$ {{ number_format($transaction->price, 2, ',', '.') }}</td>
                        <td class="text-sm-right"><a class="btn btn-outline-danger" href="{!! route('transactions.removefromcart', $transaction->id) !!}" role="button">Eliminar</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row justify-content-center">
                <div class="col-auto"><a class="btn btn-outline-danger" href="{!! route('transactions.clearcart') !!}" role="button">Vaciar</a></div>
                <div class="col-auto"><a class="btn btn-outline-primary" href="{!! route('transactions.checkout') !!}" role="button">Comprar</a></div>
                </div>
            </div>
            @else
                @include('common.alert', ['type' => 'danger', 'message' => 'Tu carrito se encuentra vacío'])
            @endif
        </div>
    </div>
</div>
@endsection
