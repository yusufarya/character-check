@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Hasil Karakter Frekuensi
    </div>
    <div class="card-body">

        <div class="mb-3">
            <div>Input 1 : <strong>{{ $resultData['input_one']}}</strong></div>
            <div>Input 2 : <strong>{{ $resultData['input_two']}}</strong></div>
        </div>

        <div class="my-3">
            @foreach ($frequency as $char => $count)
            <div>Karakter <strong>'{{$char}}'</strong> muncul <strong>{{$count}}</strong> kali di input kedua.<br></div>
            @endforeach
        </div>

        <a href="{{ route('create-character-frequency') }}" class="btn btn-secondary">Back</a>
        <a href="{{ url('/edit-character-frequency').'/'.$resultData['id'] }}" class="btn btn-outline-warning">Edit</a>
        <a href="{{ route('character-frequency-list') }}" class="btn btn-outline-success">Histories</a>
    </div>
</div>
@endsection
