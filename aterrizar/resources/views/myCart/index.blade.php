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
                        <td>@include('common.service_type', ['transaction' => $transaction])</td>
                        <td>@include('common.service_information', ['transaction' => $transaction])</td>
                        <td class="text-sm-right">@include('common.price', ['price' => $transaction->price])</td>
                        <td class="text-sm-right"><a class="btn btn-outline-danger" href="{!! route('transactions.removefromcart', $transaction->id) !!}" role="button">Eliminar</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row justify-content-center">
                <div class="col-auto"><a class="btn btn-secondary" href="{!! route('transactions.clearcart') !!}" role="button">Vaciar</a></div>
                <div class="col-auto"><a class="btn btn-primary" href="{!! route('transactions.checkout') !!}" role="button">Comprar</a></div>
                </div>
            </div>
            @else
                @include('common.alert', ['type' => 'danger', 'message' => 'Tu carrito se encuentra vacío'])
            @endif
        </div>
    </div>
</div>
@endsection
