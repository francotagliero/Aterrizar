@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card w-50 text-center">
            <div class="card-body">
                <h5 class="card-title">{{ $flight->from->name }}, {{ $flight->from->country }}</h5>
                <h5 class="card-subtitle mb-2 text-muted">{{ $flight->to->name }}, {{ $flight->to->country }}</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ Carbon\Carbon::parse($flight->date)->format('d-m-Y') }}</li>
                    <li class="list-group-item">{{ Carbon\Carbon::parse($flight->time)->format('H:i') }}</li>
                    <li class="list-group-item">{{ $flight->airline->name }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
