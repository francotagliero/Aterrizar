@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <h3 class="mb-4"><b>Buscar Habitaciones</b></h3>

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
            {!! Form::open(['route' => 'rooms.search']) !!}
            <div class="row">
                <div class='col-sm-6'>
                    <div class="form-group row">
                        {!! Form::label('city', 'Ciudad', ['class' => 'col-sm-4 col-form-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::select('city', $cities, null, ['class' => 'form-control ']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('capacity', 'Cantidad de Personas', ['class' => 'col-sm-4 col-form-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::number('capacity', '1', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('from', 'Desde', ['class' => 'col-sm-4 col-form-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::date('from', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class='col-sm-6'>
                   <div class="form-group row">
                        {!! Form::label('to', 'Hasta', ['class' => 'col-sm-4 col-form-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::date('to', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('amenities', 'Amenities', ['class' => 'col-sm-4 col-form-label']) !!}
                        <div class="col-sm-4">
                        {!! Form::select('amenities[]', $final, null, ['class' => 'form-control', 'multiple' => 'multiple', 'size' => '4']) !!}
                        </div>
                        <div class='col-auto ml-auto'>
                            {!! Form::submit('Buscar', ['class' => 'btn btn-info']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        
        @isset($rooms)
        @if ($rooms->isNotEmpty())
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Hotel</th>
                    <th>Capacidad</th>
                    <th>Precio</th>                    
                    @if(Auth::user() and Auth::user()->hasRole('user'))
                    <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                <tr>
                    <td><a href="{{ route('hotels.show', $room->id) }}">{{ $room->hotel->name }}</a></td>
                    <td>{{ $room->capacity }}</td>
                    <td>{{ number_format($room->hotel->price, 2, ',', '') }}</td>
                    @if(Auth::user() and Auth::user()->hasRole('user'))
                    <td><a class="btn btn-primary" href="#" role="button">Añadir al carrito</a></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        @endisset
    </div>
</div>
@endsection
