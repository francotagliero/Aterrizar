@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card w-50 text-center">
            <div class="card-body">
                <h5 class="card-title">{{ $car->brand->name }} {{ $car->model }}</h5>
                <h5 class="card-subtitle mb-2">Segmento: {{ $car->segment }}</h5>
                <h5 class="card-subtitle mb-2">Autonomía {{ $car->range }} KM</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Retira en: {{ $agency->city->name }}, {{ $agency->city->country }}</li>
                    <li class="list-group-item"> Compañia: {{ $agency->name }}</li>
                    <li class="list-group-item">{{ $agency->address }}</li>
                    <li class="list-group-item">Puntuación: {{ number_format($agency->averageRating, 2, ',', '') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
