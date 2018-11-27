@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="row justify-content-center">
        {!! Form::open(['route' => 'flights.store']) !!}
        <div class="form-group">
            {!! Form::label('from', 'Origen') !!}
            {!! Form::select('from', $cities, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('to', 'Destino') !!}
            {!! Form::select('to', $cities, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('date', 'Fecha') !!}
            {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('time', 'Hora') !!}
            {!! Form::time('time', '00:00', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('duration', 'Duración') !!}
            {!! Form::time('duration', '00:00', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price', 'Precio') !!}
            {!! Form::number('price', '0.0', ['class' => 'form-control', 'step'=>'0.1']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('economy_seats', 'Capacidad Económica') !!}
            {!! Form::number('economy_seats', '0', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('business_seats', 'Capacidad Ejecutiva') !!}
            {!! Form::number('business_seats', '0', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('first_class_seats', 'Capacidad Primera clase') !!}
            {!! Form::number('first_class_seats', '0', ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Guardar', ['class' => 'btn btn-info']) !!}
        {!! Form::close() !!}
    </div>
</div>

@endsection
