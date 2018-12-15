@extends('layouts.app')

@section('content')
<div class="container">
    @include('common.title', ['title' => 'Mis Compras'])
    <div class="row justify-content-center">
        @if ($transactions->isNotEmpty())
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Servicio</th>
                    <th>Información</th>
                    <th>Puntos</th>
                    <th>Asignados</th>
                    <th>Fecha</th>
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
                    <td>{{ $transaction->points }}</td>
                    <td>{{ $transaction->points_given ? 'Sí' : 'No' }}</td>
                    <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                    <td class="text-sm-right">@include('common.price', ['price' => $transaction->price])</td>
                    <td class="text-sm-right">
                    @switch($transaction->status)
                        @case('Comprado')
                        <a class="btn btn-outline-danger" href="{!! route('transactions.cancel', $transaction->id) !!}" role="button">Cancelar</a>
                            @break
                        @case('Cancelado')
                        {{-- <span class="text-danger">Cancelado</span> --}}
                        <a class="btn btn-danger disabled" href="" role="button">Cancelado</a>
                    @endswitch
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            @include('common.alert', ['type' => 'danger', 'message' => 'Tu historial de compras está vacío'])
        @endif
    </div>
</div>
@endsection
