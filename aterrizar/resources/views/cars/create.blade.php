@extends('layouts.app')

@section('content')
<div class="container">
    @include('common.title', ['title' => 'Agregar autos'])
    <div class="row justify-content-center">
        @if (session('success'))
            @include('common.alert', ['type' => 'success', 'message' => 'El auto ha sido creado correctamente'])
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-5">
            {!! Form::open(['route' => 'cars.store']) !!}
            <div class="form-group row">
                {!! Form::label('agency', 'Agencia', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::select('agency', $agencies, null, ['class' => 'form-control' . ($errors->has('agency') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('agency'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('agency') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('brand', 'Marca', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::select('brand', $brands, null, ['class' => 'form-control' . ($errors->has('brand') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('brand'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('brand') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('model', 'Modelo', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('model', null, ['class' => 'form-control' . ($errors->has('model') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('model'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('model') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('segment', 'Segmento', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::select('segment', $segments, null, ['class' => 'form-control' . ($errors->has('segment') ? ' is-invalid' : '') ]) !!}
                    @if ($errors->has('segment'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('segment') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('range', 'Autonomía', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::number('range', '0', ['class' => 'form-control' . ($errors->has('range') ? ' is-invalid' : ''), 'min' => 0 ]) !!}
                    @if ($errors->has('range'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('range') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('price', 'Precio', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::number('price', '0.0', ['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'step'=>'0.1', 'min' => 0 ]) !!}
                    @if ($errors->has('price'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('price') }}</span>
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
