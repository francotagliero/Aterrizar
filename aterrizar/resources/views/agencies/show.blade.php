@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card w-50 text-center">
            <div class="card-body">
                <h5 class="card-title">{{ $agency->name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $agency->city->name }}, {{ $agency->city->country }}</h6>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ $agency->address }}</li>
                    <li class="list-group-item">Puntuación: {{ number_format($agency->averageRating, 2, ',', '') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
