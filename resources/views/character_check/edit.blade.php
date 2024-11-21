@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Update Character</h1>
    <form action="{{ route('character-update', ['id' => $charCheck['id']]) }}" method="POST">
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
        <div class="mb-3">
            <label for="result" class="form-label">Result Percentage</label>
            <input type="text" class="form-control" id="result" name="result" value="{{ $charCheck['result_percentage'] }}" disabled>
        </div>
        <button type="submit" class="btn btn-primary me-3">Submit</button>
        <a href="{{ route('character-list') }}" class="btn btn-outline-success">Histories</a>
    </form>
</div>
@endsection
