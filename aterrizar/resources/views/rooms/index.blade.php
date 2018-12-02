@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hotel</th>
                    <th>Habitaciones</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td><a href="{{ route('hotels.show', $room->id) }}">{{ $room->hotel->name }}</a></td>
                    <td>{{ $room->capacity }}</td>
                    <td>{{ $room->from }}</td>
                    <td>{{ $room->to }}</td>
                    <td>{{ number_format($room->hotel->price, 2, ',', '') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
