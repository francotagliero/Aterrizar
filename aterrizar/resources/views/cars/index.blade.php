@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3 class="mb-4"><b>Buscar Autos</b></h3>

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
            {!! Form::open(['route' => 'cars.search']) !!}
            <div class="row">
                <div class='col-sm-6'>
                    <div class="form-group row">
                        {!! Form::label('from', 'Ciudad de Alquiler', ['class' => 'col-sm-4 col-form-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::select('from', $cities, null, ['class' => 'form-control ']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('to', 'Ciudad de Devolución', ['class' => 'col-sm-4 col-form-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::select('to', $cities, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('date_rent', 'Fecha de Alquiler', ['class' => 'col-sm-4 col-form-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::date('date_rent', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class='col-sm-6'>
                    <div class="form-group row">
                        {!! Form::label('brand', 'Modelo', ['class' => 'col-sm-4 col-form-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::select('brand', $car_brands, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                   <div class="form-group row">
                        {!! Form::label('date_return', 'Fecha de Devolución', ['class' => 'col-sm-4 col-form-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::date('date_return', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('agency', 'Compañia', ['class' => 'col-sm-4 col-form-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::select('agency', $car_rental_agencies, null, ['class' => 'form-control']) !!}
                        </div>
                        <div class='col-auto  ml-auto'>
                            {!! Form::submit('Buscar', ['class' => 'btn btn-info']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        
        @isset($cars)
        @if ($cars->isNotEmpty())
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Segmento</th>
                    <th>Precio</th>
                    <th>Autonomía</th>
                    <th>Agencia</th>
                    @if(Auth::user() and Auth::user()->hasRole('user'))
                    <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                <tr>
                    <td>{{ $car->brand->name }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->segment }}</td>
                    <td>{{ number_format($car->price, 2, ',', '') }}</td>
                    <td>{{ $car->range }}</td>
                    <td><a href="{{ route('agencies.show', $car->agency->id) }}">{{ $car->agency->name }}</a></td>
                    @if(Auth::user() and Auth::user()->hasRole('user'))
                    <td><a class="btn btn-primary" href="#" role="button">Añadir al carrito</a></td>
                    @endif
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
