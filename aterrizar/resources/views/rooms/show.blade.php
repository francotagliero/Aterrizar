@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card w-50 text-center">
            <div class="card-body">
                <h5 class="card-title">{{ $hotel->name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $hotel->city->name }}, {{ $hotel->city->country }}</h6>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Desde el: {{ Carbon\Carbon::parse($transaction->from)->format('d-m-Y') }} hasta el: {{ Carbon\Carbon::parse($transaction->to)->format('d-m-Y') }}</li>
                    <li class="list-group-item">Capacidad: {{ $room->capacity }}</li>
                    <li class="list-group-item">{{ $hotel->stars }} estrellas</li>
                    <li class="list-group-item">Puntuación: {{ number_format($hotel->averageRating, 2, ',', '') }}</li>
                    <li class="list-group-item">Incluye: {{ implode(', ', $hotel->amenities) }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
