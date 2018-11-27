@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ciudad</th>
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
                    <td>{{ $room->city->name }}</td>
                    <td>{{ $room->hotel->name }}</td>
                    <td>{{ $room->rooms }}</td>
                    <td>{{ $room->from }}</td>
                    <td>{{ $room->to }}</td>
                    <td>{{ $room->hotel->price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
