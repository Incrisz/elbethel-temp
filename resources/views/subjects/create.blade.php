@extends('layouts.app')

@section('title', 'Add Subject')

@section('content')
    <h2>Add Subject</h2>
    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <!-- <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div> -->
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
