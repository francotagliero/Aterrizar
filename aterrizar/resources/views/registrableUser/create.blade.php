@extends('layouts.app')

@section('content')
<div class="container">
    @include('common.title', ['title' => 'Agregar un usuario'])
    <div class="row justify-content-center">
        <div class="col-sm-5">
            {!! Form::open(['route' => 'givenregistration.store']) !!}
            <div class="form-group row">
                {!! Form::label('email', 'E-Mail', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '') ]) !!}
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
                @endif
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('role', 'Rol', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::select('role', $roles, null, ['class' => 'form-control' . ($errors->has('role') ? ' is-invalid' : '') ]) !!}
                @if ($errors->has('role'))
                    <span class="invalid-feedback" role="alert">{{ $errors->first('rol') }}</span>
                @endif
                </div>
            </div>
            <div class="form-group row justify-content-center">
                {!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
