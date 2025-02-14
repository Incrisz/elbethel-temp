@extends('layouts.app')

@section('content')
    <h1>Edit Student Record</h1>
    
    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Days Present</label>
            <input type="number" name="no_of_days_present" class="form-control" 
                   value="{{ $student->no_of_days_present }}" required>
        </div>
        <div class="mb-3">
            <label>Teacher Comments</label>
            <textarea name="teacher_comments" class="form-control">{{ $student->teacher_comments }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Record</button>
    </form>
@endsection