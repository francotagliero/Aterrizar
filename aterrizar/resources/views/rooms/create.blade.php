@extends('layouts.app')

@section('content')
<div class="container">
    @include('common.title', ['title' => 'Agregar hospedaje'])
    <div class="row justify-content-center">
        @if (session('success'))
            @include('common.alert', ['type' => 'success', 'message' => 'La habitación ha sido creada correctamente'])
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-5">
            {!! Form::open(['route' => 'rooms.store']) !!}
            <div class="form-group row">
                {!! Form::label('hotel', 'Hotel', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::select('hotel', $hotels, null, ['class' => 'form-control' . ($errors->has('hotel') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('hotel'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('hotel') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('capacity', 'Capacidad', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::number('capacity', '0', ['class' => 'form-control' . ($errors->has('capacity') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('capacity'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('capacity') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('from', 'Desde', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::date('from', \Carbon\Carbon::now(), ['class' => 'form-control' . ($errors->has('from') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('from'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('from') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('to', 'Hasta', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::date('to', \Carbon\Carbon::now(), ['class' => 'form-control' . ($errors->has('to') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('to'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('to') }}</span>
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
