@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Hasil Persentase Karakter</h1>
    <p><strong>Input 1:</strong> {{ $resultData['input_one'] }}</p>
    <p><strong>Input 2:</strong> {{ $resultData['input_two'] }}</p>
    <p><strong>Persentase:</strong> {{ $resultData['result_percentage'] }}%</p>
    <a href="{{ route('create-character') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ url('/edit-character').'/'.$resultData['id'] }}" class="btn btn-outline-warning">Ubah</a>
    <a href="{{ route('character-list') }}" class="btn btn-outline-success">Riwayat</a>
</div>
@endsection
