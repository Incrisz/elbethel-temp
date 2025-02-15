@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Subject</h2>
    
    <form action="{{ route('subjects.update', $subject) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Subject Name</label>
            <input type="text" class="form-control" id="name" name="name" 
                   value="{{ old('name', $subject->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Update Subject</button>
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection