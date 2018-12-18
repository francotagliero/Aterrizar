@extends('layouts.app')

@section('content')
<div class="container">
    @include('common.title', ['title' => 'Calificar hotel'])
    <div class="row justify-content-center">
        <h2>{{ $hotel->name }}</h2>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-sm-5">
            {!! Form::open(['route' => ['hotels.storeRating', 'hotel' => $hotel->id]]) !!}
            <div class="form-group row">
                {!! Form::label('rating', 'Puntuación', ['class' => 'col col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::select('rating', $ratings, null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row justify-content-center">
                {!! Form::submit('Calificar', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
