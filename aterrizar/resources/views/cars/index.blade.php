@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
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
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->brand->name }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->segment }}</td>
                    <td>{{ $car->price }}</td>
                    <td>{{ $car->range }}</td>
                    <td><a href="{{ route('agencies.show', $car->agency->id) }}">{{ $car->agency->name }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
