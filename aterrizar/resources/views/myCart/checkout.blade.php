@extends('layouts.app')

@section('content')
<div class="container">
    @include('common.title', ['title' => 'Confirmación de compra'])

    @if ($errors->any())
        <div class="col-sm-12 alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-sm-8">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Servicio</th>
                        <th>Información</th>
                        <th class="text-sm-right">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        @switch($transaction->service->service_type)
                            @case('Flight')
                                <td>Vuelo</td>
                                <td>
                                {{ $transaction->service->from->name }} &gt; {{ $transaction->service->to->name }}
                                ({{ Carbon\Carbon::parse($transaction->service->date)->format('d-m-Y') }})
                                @if ($transaction->detail->stop !== null)
                                <br>
                                {{ $transaction->detail->stop->from->name }} &gt; {{ $transaction->detail->stop->to->name }}
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
                                <td>
                                {{ $transaction->service->brand->name }} {{ $transaction->service->model }}
                                <br>
                                {{ $transaction->service->agency->name }}
                                <br>
                                Del {{ Carbon\Carbon::parse($transaction->service->from)->format('d-m-Y') }} al {{ Carbon\Carbon::parse($transaction->service->to)->format('d-m-Y') }}
                                </td>
                                @break
                            @case('Room')
                                <td>Habitación</td>
                                <td>
                                Hotel {{ $transaction->service->hotel->name }}
                                ({{ $transaction->service->capacity }} personas)
                                <br>
                                Del {{ Carbon\Carbon::parse($transaction->service->from)->format('d-m-Y') }} al {{ Carbon\Carbon::parse($transaction->service->to)->format('d-m-Y') }}
                                </td>
                        @endswitch
                        <td class="text-sm-right">$ {{ number_format($transaction->price, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card col-sm-4 text-center">
            <div class="card-body">
                <h3 class="card-title">Resumen</h3>

                {!! Form::open(['route' => 'transactions.confirmcheckout']) !!}
                <div class="form-group row">
                    {!! Form::label('total', 'Compra', ['class' => 'col-auto mr-auto col-form-label']) !!}
                    <div class="col-2">
                    {!! Form::text('prefix', '$', ['readonly' => true, 'class' => 'form-control-plaintext text-right']) !!}
                    </div>
                    <div class="col-4">
                    {!! Form::text('total', number_format($total, 2, ',', '.'), ['readonly' => true, 'class' => 'form-control-plaintext text-right']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('points', 'Puntos (' . $availablePoints . ' disponibles)', ['class' => 'col-auto mr-auto col-form-label']) !!}
                    <div class="col-5">
                        {!! Form::number('points', '0', ['min' => '0', 'max' => $availablePoints, 'class' => 'form-control text-right', 'id' => 'input_points']) !!}
                    </div>
                </div>
                <div class="form-group row border-bottom">
                    {!! Form::label('discount', 'Descuento', ['class' => 'col-auto mr-auto col-form-label']) !!}
                    <div class="col-2">
                    {!! Form::text('prefix_discount', '- $', ['readonly' => true, 'class' => 'text-danger form-control-plaintext text-right']) !!}
                    </div>
                    <div class="col-4">
                    {!! Form::text('discount', number_format(0, 2, ',', '.'), ['readonly' => true, 'class' => 'text-danger form-control-plaintext text-right', 'id' => 'text_discount']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-2 ml-auto">
                    {!! Form::text('prefix_discount', '$', ['readonly' => true, 'class' => 'h3 form-control-plaintext text-right']) !!}
                    </div>
                    <div class="col-6">
                        {!! Form::text('final', number_format($total, 2, ',', '.'), ['readonly' => true, 'class' => 'h3 form-control-plaintext text-right', 'id' => 'text_final']) !!}
                    </div>
                </div>
                {!! Form::submit('Comprar', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script>
var pesos_per_point = {!! $pesos_per_point !!};
var total = {!! $total !!};
var numberFormat = new Intl.NumberFormat('es-AR', { style: 'decimal', minimumFractionDigits: 2 });
document.addEventListener('DOMContentLoaded', function () {
    var input_points = document.getElementById('input_points');
    var discount = 0;
    input_points.addEventListener('change', function() {
        discount = input_points.value * pesos_per_point;
        document.getElementById('text_discount').value = numberFormat.format(discount);
        document.getElementById('text_final').value = numberFormat.format(total - discount);
    });
});
</script>
@endsection

