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
        {!! Form::open(['route' => 'myprofile.store']) !!}
        <div class="form-group">
            {!! Form::label('dni', 'DNI') !!}
            {!! Form::text('dni', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('username', 'Usuario') !!}
            {!! Form::text('username', null, ['class' => 'form-control', 'step'=>'0.1']) !!}
        </div>
        {!! Form::submit('Guardar', ['class' => 'btn btn-info']) !!}
        {!! Form::close() !!}
    </div>
</div>

@endsection
