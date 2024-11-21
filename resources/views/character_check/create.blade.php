@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Penghitungan Persentase Karakter</h1>
    <p>Pengecekan dua free input dan system akan menghitung berapa persen karakter dari input pertama ada di input kedua</p>
    <form action="{{ route('character-check') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="input1" class="form-label">Input 1</label>
            <input type="text" class="form-control @error('input1') is-invalid @enderror" id="input1" name="input1">
            @error('input1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="input2" class="form-label">Input 2</label>
            <input type="text" class="form-control @error('input2') is-invalid @enderror" id="input2" name="input2">
            @error('input2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary me-3">Submit</button>
        <a href="{{ route('character-list') }}" class="btn btn-outline-success">Riwayat</a>
    </form>
</div>
@endsection
