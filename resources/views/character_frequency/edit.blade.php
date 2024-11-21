@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ubah Frekuensi Karakter</h1>
    <form action="{{ route('character-frequency-update', ['id' => $charCheck['id']]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="input1" class="form-label">Input 1</label>
            <input type="text" class="form-control" id="input1" name="input1" value="{{ $charCheck['input_one'] }}" required>
        </div>
        <div class="mb-3">
            <label for="input2" class="form-label">Input 2</label>
            <input type="text" class="form-control" id="input2" name="input2" value="{{ $charCheck['input_two'] }}" required>
        </div>
        {{-- <div class="mb-3">
            <label for="result" class="form-label">Hasil Persentase</label>
            <input type="text" class="form-control" id="result" name="result" value="{{ $charCheck['result_percentage'] }}" disabled>
        </div> --}}
        <button type="submit" class="btn btn-primary me-3">Simpan</button>
        <a href="{{ route('character-frequency-list') }}" class="btn btn-outline-success">Riwayat</a>
    </form>
</div>
@endsection
