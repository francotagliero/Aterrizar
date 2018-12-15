@extends('layouts.app')

@section('content')
<div class="container">
    @include('common.title', ['title' => 'Bienvenido a Aterrizar'])
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <a title="Buscar vuelos" href="{{ route('flights.index') }}">
                    <img class="card-img-top" src="{{ asset('img/flight.jpg') }}" alt="Vuelo">
                </a>
                <div class="card-body bg-white pt-4 pb-3 text-center">
                    <a class="nav-link text-secondary" title="Buscar vuelos" href="{{ route('flights.index') }}">
                        <i class="fas fa-plane fa-4x"></i><br><h3>Buscar vuelos</h3>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <a title="Buscar autos" href="{{ route('cars.index') }}">
                    <img class="card-img-top" src="{{ asset('img/car.jpg') }}" alt="Vuelo">
                </a>
                <div class="card-body bg-white pt-4 pb-3 text-center">
                    <a class="nav-link text-secondary" title="Buscar autos" href="{{ route('cars.index') }}">
                        <i class="fas fa-car fa-4x"></i><br><h3>Buscar autos</h3>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <a title="Buscar hospedaje" href="{{ route('rooms.index') }}">
                    <img class="card-img-top" src="{{ asset('img/room.jpg') }}" alt="Vuelo">
                </a>
                <div class="card-body bg-white pt-4 pb-3 text-center">
                    <a class="nav-link text-secondary" title="Buscar hospedaje" href="{{ route('rooms.index') }}">
                        <i class="fas fa-concierge-bell fa-4x"></i><br><h3>Buscar hospedaje</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
