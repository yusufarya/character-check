@extends('layouts.app')

@section('title', 'Create Data')

@section('content')
<div class="container">
    <h1>Frekuensi Karakter</h1>
    <p>Fungsi ini menghitung frekuensi kemunculan setiap karakter dari string Input 1 di Input 2.</p>
    <form action="{{ route('character-frequency-check') }}" method="POST">
        @csrf
        <div class="my-3">
            <label for="input1" class="form-label">Dari Karakter Yang Sudah Ada</label>
            <select name="char_id" id="char_id" class="form-select">
                <option value="">Pilih data </option>
                @foreach ($charCheck as $item)
                    <option value="{{$item->id}}">{{$item->input_two}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="input1" class="form-label">Input 1</label>
            <input type="text" class="form-control @error('input1') is-invalid @enderror" id="input1" name="input1" >
            @error('input1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="input2" class="form-label">Input 2</label>
            <input type="text" class="form-control @error('input2') is-invalid @enderror" id="input2" name="input2" >
            @error('input2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary me-3">Submit</button>
        <a href="{{ route('character-frequency-list') }}" class="btn btn-outline-success">Riwayat</a>
    </form>
</div>

@endsection

@section('page-script')
    <script>
        let charCheck = '<?php echo json_encode($charCheck) ?>';
    </script>
    @vite('resources/js/character_frequency/create.js')
@endsection
