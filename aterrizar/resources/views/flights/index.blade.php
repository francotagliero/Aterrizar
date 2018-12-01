@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Duración</th>
                    <th>Precio</th>
                    <th>Aerolínea</th>
                    <th>Capacidad Económica</th>
                    <th>Capacidad Ejecutiva</th>
                    <th>Capacidad Primera clase</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flights as $flight)
                <tr>
                    <td>{{ $flight->id }}</td>
                    <td>{{ $flight->from->name }}</td>
                    <td>{{ $flight->to->name }}</td>
                    <td>{{ Carbon\Carbon::parse($flight->date)->format('Y-m-d') }}</td>
                    <td>{{ Carbon\Carbon::parse($flight->time)->format('H:i') }}</td>
                    <td>{{ Carbon\Carbon::parse($flight->duration)->format('H:i') }}</td>
                    <td>{{ number_format($flight->price, 2, ',', '') }}</td>
                    <td>{{ $flight->airline->name }}</td>
                    <td>{{ $flight->economy_seats }}</td>
                    <td>{{ $flight->business_seats }}</td>
                    <td>{{ $flight->first_class_seats }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
