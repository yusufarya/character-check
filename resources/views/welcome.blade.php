@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="card">
    <div class="card-header">
        Welcome To Character Check App
    </div>
    <div class="card-body">
        {{-- <h5 class="card-title"></h5> --}}
        <p class="card-text">Aplikasi ini dibuat untuk menghitung persentase karakter dan frekuensi karakter.</p>
        <a href="{{ route('create-character') }}" class="btn btn-outline-primary">Coba hitung persentase</a>
        <a href="{{ route('create-character-frequency') }}" class="btn btn-outline-success">Coba frekuensi karakter</a>
    </div>
</div>
@endsection
