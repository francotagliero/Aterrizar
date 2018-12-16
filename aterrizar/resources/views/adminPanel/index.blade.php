@extends('layouts.app')

@section('content')
<div class="container">
    @include('common.title', ['title' => 'Panel de Administración'])
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
        <div class="col-sm-5">
            {!! Form::open(['route' => 'adminpanel.store']) !!}
            <div class="form-group row">
                {!! Form::label('max_flight_duration', 'Duración máxima de vuelo', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-4">
                    {!! Form::number('max_flight_duration', $adminPanel->max_flight_duration, ['class' => 'form-control', 'min' => 0]) !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::text('hs_1', 'hs', ['readonly' => true, 'class' => 'form-control-plaintext text-left']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('percentage_stopover', 'Descuento por escala', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-4">
                    {!! Form::number('percentage_stopover', $adminPanel->percentage_stopover * 100, ['class' => 'form-control', 'min' => 0, 'max' => 100]) !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::text('perc_1', '%', ['readonly' => true, 'class' => 'form-control-plaintext text-left']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('max_gap', 'Gap máximo', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-4">
                    {!! Form::number('max_gap', $adminPanel->max_gap, ['class' => 'form-control', 'min' => 0]) !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::text('hs_2', 'hs', ['readonly' => true, 'class' => 'form-control-plaintext text-left']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('return_tax', 'Recargo por devolución', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-4">
                    {!! Form::number('return_tax', $adminPanel->return_tax * 100, ['class' => 'form-control', 'min' => 0, 'max' => 100]) !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::text('perc_2', '%', ['readonly' => true, 'class' => 'form-control-plaintext text-left']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('points_per_peso', 'Puntos por peso', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-4">
                    {!! Form::number('points_per_peso', $adminPanel->points_per_peso, ['class' => 'form-control', 'min' => 0, 'step' => 0.25]) !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::text('points', 'puntos', ['readonly' => true, 'class' => 'form-control-plaintext text-left']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('pesos_per_point', 'Pesos por punto', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-4">
                    {!! Form::number('pesos_per_point', $adminPanel->pesos_per_point, ['class' => 'form-control', 'min' => 0, 'step' => 0.25]) !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::text('pesos', '$', ['readonly' => true, 'class' => 'form-control-plaintext text-left']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('firstclass_factor', 'Factor Primera Clase', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-4">
                    {!! Form::number('firstclass_factor', $adminPanel->firstclass_factor * 100, ['class' => 'form-control', 'min' => 0, 'max' => 100]) !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::text('perc_3', '%', ['readonly' => true, 'class' => 'form-control-plaintext text-left']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('bussinessclass_factor', 'Factor Bussiness', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-4">
                    {!! Form::number('bussinessclass_factor', $adminPanel->bussinessclass_factor * 100, ['class' => 'form-control', 'min' => 0, 'max' => 100]) !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::text('perc_4', '%', ['readonly' => true, 'class' => 'form-control-plaintext text-left']) !!}
                </div>
            </div>
            <div class="form-group row justify-content-center">
                {!! Form::submit('Guardar', ['class' => 'btn btn-info']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
