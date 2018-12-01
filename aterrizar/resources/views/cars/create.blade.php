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
        {!! Form::open(['route' => 'cars.store']) !!}
        <div class="form-group">
            {!! Form::label('agency', 'Agencia') !!}
            {!! Form::select('agency', $agencies, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('brand', 'Marca') !!}
            {!! Form::select('brand', $brands, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('model', 'Modelo') !!}
            {!! Form::text('model', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('segment', 'Segmento') !!}
            {!! Form::select('segment', $segments, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('range', 'Autonomía') !!}
            {!! Form::number('range', '0', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price', 'Precio') !!}
            {!! Form::number('price', '0.0', ['class' => 'form-control', 'step'=>'0.1']) !!}
        </div>
        {!! Form::submit('Guardar', ['class' => 'btn btn-info']) !!}
        {!! Form::close() !!}
    </div>
</div>

@endsection
