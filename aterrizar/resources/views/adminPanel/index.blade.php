@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
         <h1> Panel de Administración </h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Máxima Duración de Vuelo</th>
                    <th>Recargo por Escala</th>
                    <th>Maximo Gap</th>
                    <th>Recargo por Devolucion</th>
                    <th>Puntos por peso</th>
                    <th>Pesos por punto</th>
                    <th>Factor Primera Clase</th>
                    <th>Factor Bussiness</th>


                </tr>
            </thead>
            <tbody>
                @foreach($adminPanel as $panel)
                <tr>
                    <td>{{ $panel->max_flight_duration }}</td>
                    <td>{{ ($panel->percentage_stopover * 100).'%' }}</a></td>
                    <td>{{ $panel->max_gap }}</td>
                    <td>{{ ($panel->return_tax * 100).'%' }}</td>
                    <td>{{ $panel->points_per_peso }}</td>
                    <td>{{ $panel->pesos_per_point }}</td>
                    <td>{{ ($panel->firstclass_factor * 100).'%' }}</td>
                    <td>{{ ($panel->bussinessclass_factor * 100).'%' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
