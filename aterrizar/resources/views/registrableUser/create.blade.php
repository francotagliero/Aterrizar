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
        {!! Form::open(['route' => 'givenregistration.store']) !!}
        <div class="form-group">
        <label for="email">{{ __('E-Mail') }}</label>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('roles', 'Rol') !!}
            {!! Form::select('roles', $roles, null, ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Guardar', ['class' => 'btn btn-info']) !!}
        {!! Form::close() !!}
    </div>
</div>

@endsection
