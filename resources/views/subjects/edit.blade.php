@extends('layouts.app')

@section('title', 'Edit Subject')

@section('content')
    <h2>Edit Subject</h2>
    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $subject->name }}" required>
        </div>
        <!-- <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $subject->description }}</textarea>
        </div> -->
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
