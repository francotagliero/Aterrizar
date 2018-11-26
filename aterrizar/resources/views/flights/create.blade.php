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
        {!! Form::open(['route' => 'flights.store']) !!}
        <div class="form-group">
            {!! Form::label('from', 'From') !!}
            {!! Form::select('from', $cities, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('to', 'To') !!}
            {!! Form::select('to', $cities, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('date', 'Date') !!}
            {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('time', 'Time') !!}
            {!! Form::time('time', '00:00', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('duration', 'Duration') !!}
            {!! Form::time('duration', '00:00', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price', 'price') !!}
            {!! Form::number('price', '0.0', ['class' => 'form-control', 'step'=>'0.1']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('economy_seats', 'economy_seats') !!}
            {!! Form::number('economy_seats', '0', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('business_seats', 'business_seats') !!}
            {!! Form::number('business_seats', '0', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('first_class_seats', 'first_class_seats') !!}
            {!! Form::number('first_class_seats', '0', ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}
        {!! Form::close() !!}
    </div>
</div>

@endsection
