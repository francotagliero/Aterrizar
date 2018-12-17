@extends('layouts.app')

@section('content')
<div class="container">
    @include('common.title', ['title' => 'Agregar vuelos'])
    <div class="row justify-content-center">
        @if (session('success_one'))
            @include('common.alert', ['type' => 'success', 'message' => 'El vuelo ha sido creado correctamente'])
        @elseif (session('success_many'))
            @include('common.alert', ['type' => 'success', 'message' => 'Los vuelos han sido creados correctamente'])
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-5">
            {!! Form::open(['route' => 'flights.store']) !!}
            <div class="form-group row">
                {!! Form::label('from', 'Origen', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::select('from', $cities, null, ['class' => 'form-control' . ($errors->has('from') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('from'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('from') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('to', 'Destino', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::select('to', $cities, null, ['class' => 'form-control' . ($errors->has('to') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('to'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('to') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('date', 'Fecha', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('date'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('date') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('whole_week', 'Toda la semana', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    <div class="form-check">
                        {!! Form::checkbox('whole_week', '1', null, ['class' => 'form-check-input']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('time', 'Hora', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::time('time', '00:00', ['class' => 'form-control' . ($errors->has('time') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('time'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('time') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('duration', 'Duración', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::time('duration', '00:00', ['class' => 'form-control' . ($errors->has('duration') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('duration'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('duration') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('price', 'Precio', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::number('price', '0.0', ['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'step'=>'0.1' ]) !!}
                    @if ($errors->has('price'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('price') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('airline', 'Aerolínea', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::select('airline', $airlines, null, ['class' => 'form-control' . ($errors->has('airline') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('airline'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('airline') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('economy_seats', 'Capacidad Económica', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::number('economy_seats', '0', ['class' => 'form-control' . ($errors->has('economy_seats') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('economy_seats'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('economy_seats') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('business_seats', 'Capacidad Ejecutiva', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::number('business_seats', '0', ['class' => 'form-control' . ($errors->has('business_seats') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('business_seats'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('business_seats') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('first_class_seats', 'Capacidad Primera clase', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::number('first_class_seats', '0', ['class' => 'form-control' . ($errors->has('first_class_seats') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('first_class_seats'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('first_class_seats') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row justify-content-center">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
