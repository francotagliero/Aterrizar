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
                    <td>{{ $flight->date }}</td>
                    <td>{{ $flight->time }}</td>
                    <td>{{ $flight->duration }}</td>
                    <td>{{ $flight->price }}</td>
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
