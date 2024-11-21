@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="card">
    <div class="card-header">
        Hasil Karakter Frekuensi
    </div>
    <div class="card-body">

        <div class="mb-3">
            <div>Input 1 : <strong>{{ $inputParams['one']}}</strong></div>
            <div>Input 2 : <strong>{{ $inputParams['two']}}</strong></div>
        </div>

        @foreach ($resultData as $char => $count)
        <div>Karakter <strong>'{{$char}}'</strong> muncul <strong>{{$count}}</strong> kali di input kedua.<br></div>
        @endforeach

        <div class="mt-3">
            <a href="{{ route('create-character-frequency') }}" class="btn btn-outline-primary">Coba Lagi</a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#saveModal">
                Simpan
            </button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="saveModalLabel">Simpan Frekuensi Karakter ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('character-frequency-store') }}" method="POST">
                @csrf
                @php
                    $char_id = isset($inputParams['char_id']) ? $inputParams['char_id'] : '';
                @endphp
                <div class="modal-body">
                    <input type="hidden" name="char_id" id="char_id" value="{{ $char_id }}">
                    <div class="mb-3">
                        <label for="input1" class="form-label">Input 1</label>
                        <input type="text" class="form-control" id="input1" name="input1" value="{{ $inputParams['one'] }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="input2" class="form-label">Input 2</label>
                        <input type="text" class="form-control" id="input2" name="input2" value="{{ $inputParams['two'] }}" readonly>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
