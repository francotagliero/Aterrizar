@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="row justify-content-center">
        {!! Form::open(['route' => 'rooms.store']) !!}
        <div class="form-group">
            {!! Form::label('hotel', 'Hotel') !!}
            {!! Form::select('hotel', $hotels, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('capacity', 'Habitaciones') !!}
            {!! Form::number('capacity', '0', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('from', 'Desde') !!}
            {!! Form::date('from', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('to', 'Hasta') !!}
            {!! Form::date('to', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Guardar', ['class' => 'btn btn-info']) !!}
        {!! Form::close() !!}
    </div>
</div>

@endsection
