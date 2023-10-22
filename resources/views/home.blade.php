@extends('app')

@if(is_null(auth()->user()->idrole))
@section('content')
    <center>
        <h1>Kamu belum memiliki role</h1>
        <span>Tunggu admin memberikan role untuk kamu</span>
    </center>
@endsection
@else
@section('content')
    <h1 style="text-align: center">Selamat Datang,  {{ auth()->user()->name }}</h1>
@endsection
@endif
