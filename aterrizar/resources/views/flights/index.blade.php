@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('common.title', ['title' => 'Buscar vuelos'])

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
                            {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
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
                    <th class="text-sm-right">Precio</th>
                    <th>Aerolínea</th>
                    @if (old('class') == 'Economy')
                    <th>Capacidad Económica</th>
                    @elseif (old('class') == 'Business')
                    <th>Capacidad Ejecutiva</th>
                    @elseif (old('class') == 'First')
                    <th>Capacidad Primera clase</th>
                    @endif
                    @if(Auth::user() and Auth::user()->hasRole('user'))
                    <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($flights as $flight)
                @foreach($flight['stops'] as $stop)
                <tr>
                    <td>{{ $stop->from->name }}</td>
                    <td>{{ $stop->to->name }}</td>
                    <td>{{ Carbon\Carbon::parse($stop->date)->format('Y-m-d') }}</td>
                    <td>{{ Carbon\Carbon::parse($stop->time)->format('H:i') }}</td>
                    <td>{{ Carbon\Carbon::parse($stop->duration)->format('H:i') }}</td>
                    @if($loop->count == 1)
                    <td class="text-sm-right">@include('common.price', ['price' => $flight['price']])</td>
                    @elseif($loop->first)
                    <td rowspan="{!! $loop->count !!}" class="align-middle text-sm-right">@include('common.price', ['price' => $flight['price']])</td>
                    @endif
                    <td>{{ $stop->airline->name }}</td>
                    @if (old('class') == 'Economy')
                    <td>{{ $stop->economy_seats }}</td>
                    @elseif (old('class') == 'Business')
                    <td>{{ $stop->business_seats }}</td>
                    @elseif (old('class') == 'First')
                    <td>{{ $stop->first_class_seats }}</td>
                    @endif
                    @if(Auth::user() and Auth::user()->hasRole('user'))
                        @if($loop->count == 1)
                        <td><a class="btn btn-primary" href="{{ $flight['route'] }}" role="button">Añadir al carrito</a></td>
                        @elseif($loop->first)
                        <td rowspan="{!! $loop->count !!}" class="align-middle"><a class="btn btn-primary" href="{{ $flight['route'] }}" role="button">Añadir al carrito</a></td>
                        @endif
                    @endif
                </tr>
                @endforeach
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
