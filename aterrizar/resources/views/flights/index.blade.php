@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <h3 class="mb-4"><b>Buscar vuelos</b></h3>

        @if ($errors->any())
        <div class="col-sm-12 alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class='col-sm-12 mb-4'>
            {!! Form::open(['route' => 'flights.search']) !!}
            <div class="row">
                <div class='col-sm-6'>
                    <div class="form-group row">
                        {!! Form::label('from', 'Origen', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('from', $cities, null, ['class' => 'form-control ']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('to', 'Destino', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('to', $cities, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('date', 'Fecha', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class='col-sm-6'>
                    <div class="form-group row">
                        {!! Form::label('seats', 'Asientos', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::number('seats', '1', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('class', 'Clase', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('class', ['Economy' => 'Económica', 'Business' => 'Ejecutiva',  'First' => 'Primera'], null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('non_stop', 'Sin escalas', ['class' => 'col-auto col-form-label']) !!}
                        <div class="col-auto">
                            <div class="form-check">
                                {!! Form::checkbox('non_stop', '1', null, ['class' => 'form-check-input']) !!}
                            </div>
                        </div>
                        <div class='col-auto ml-auto'>
                            {!! Form::submit('Buscar', ['class' => 'btn btn-info']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        @isset($flights)
        @if (! empty($flights))
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Duración</th>
                    <th>Precio</th>
                    <th>Aerolínea</th>
                    <th>Capacidad Económica</th>
                    <th>Capacidad Ejecutiva</th>
                    <th>Capacidad Primera clase</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($flights as $flight)
                <tr>
                    <td>{{ $flight->from->name }}</td>
                    <td>{{ $flight->to->name }}</td>
                    <td>{{ Carbon\Carbon::parse($flight->date)->format('Y-m-d') }}</td>
                    <td>{{ Carbon\Carbon::parse($flight->time)->format('H:i') }}</td>
                    <td>{{ Carbon\Carbon::parse($flight->duration)->format('H:i') }}</td>
                    <td>{{ number_format($flight->price, 2, ',', '.') }}</td>
                    <td>{{ $flight->airline->name }}</td>
                    <td>{{ $flight->economy_seats }}</td>
                    <td>{{ $flight->business_seats }}</td>
                    <td>{{ $flight->first_class_seats }}</td>
                    <td><a class="btn btn-primary" href="#" role="button">Añadir al carrito</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            @include('common.alert', ['type' => 'danger', 'message' => 'La búsqueda no arrojó ningún resultado'])
        @endif
        @endisset
    </div>
</div>
@endsection
