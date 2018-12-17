@extends('layouts.app')

@section('content')
<div class="container">
    @auth
    @include('common.title', ['title' => Auth::user()->name . ', bienvenido a Aterrizar'])
    @endauth
    @guest
    @include('common.title', ['title' => 'Bienvenido a Aterrizar'])
    @endguest
@endsection
