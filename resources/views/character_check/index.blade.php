@extends('layouts.app')

@section('title', 'List data karakter')

@section('content')
<div class="card">
    <div class="card-header">
        Riwayat Persentase Karakter
    </div>
    <div class="card-body">
        <a href="{{ route('create-character') }}" class="btn btn-outline-primary">Coba hitung persentase karakter</a>
        <table class="table table-bordered my-3">
            <thead>
                <tr>
                    <th style="width: 7%">ID.</th>
                    <th>Input1</th>
                    <th>Input2</th>
                    <th class="text-end">Persentase</th>
                    <th class="text-center" style="width: 14%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resultData as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->input_one }}</td>
                        <td>{{ $row->input_two }}</td>
                        <td class="text-end">{{ $row->result_percentage }} %</td>
                        <td class="text-center">
                            <a href="{{ url('/generate-frequency').'/'.$row->id }}" class="btn btn-sm btn-success">
                                Generate Frekuensi
                            </a>
                            <a href="{{ url('/edit-character').'/'.$row->id }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <a href="#" class="btn btn-sm btn-danger" id="delete_data" data-id="{{ $row->id }}" data-imput1="{{ $row->input_one }}">
                                Hapus
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Data ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('character-delete') }}" method="POST">
                @csrf
                <div class="modal-body" hidden>
                    <input type="hidden" id="id" name="id">
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

@section('page-script')
    @vite('resources/js/character_check/index.js')
@endsection
