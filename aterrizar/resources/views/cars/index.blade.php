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
                        {!! Form::label('from', 'Ciudad de Alquiler', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('from', $cities, null, ['class' => 'form-control ']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('to', 'Ciudad de Devolución', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('to', $cities, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('date_rent', 'Fecha de Alquiler', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::date('date_rent', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class='col-sm-6'>
                    <div class="form-group row">
                        {!! Form::label('brand', 'Modelo', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('brand', $car_brands, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                   <div class="form-group row">
                        {!! Form::label('date_return', 'Fecha de Devolución', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::date('date_return', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('agency', 'Compañia', ['class' => 'col-auto col-form-label']) !!}
                        <div class="col-auto">
                            <div class="form-check">
                                {!! Form::select('agency', $car_rental_agencies, ['class' => 'form-control']) !!}
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
        @isset($cars)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Segmento</th>
                    <th>Precio</th>
                    <th>Autonomía</th>
                    <th>Agencia</th>
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
                    <td><a class="btn btn-primary" href="#" role="button">Añadir al carrito</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endisset
    </div>
</div>
@endsection
