@extends('layouts.app')

@section('content')
    <h1>Enter Scores for {{ $student->name }}</h1>
    
    <form action="{{ route('scores.store', $student) }}" method="POST">
    @csrf
    <div class="row g-3">
        <!-- Subject Selection -->
        <div class="col-md-3">
            <label class="form-label">Subject</label>
            <select name="subject_id" class="form-select" required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- CA and Exam Scores -->
        <div class="col-md-2">
            <label class="form-label">CA1</label>
            <input type="number" name="ca1" class="form-control" min="0" max="30" required>
        </div>
        <div class="col-md-2">
            <label class="form-label">CA2</label>
            <input type="number" name="ca2" class="form-control" min="0" max="30" required>
        </div>
        <div class="col-md-2">
            <label class="form-label">CA3</label>
            <input type="number" name="ca3" class="form-control" min="0" max="30" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Exam</label>
            <input type="number" name="exam" class="form-control" min="0" max="70" required>
        </div>

        <!-- Additional Fields -->
        <div class="col-md-3">
            <label class="form-label">Position in Subject</label>
            <input type="number" name="position_in_subject" class="form-control" min="1" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Class Average (%)</label>
            <input type="number" step="0.01" name="class_average" class="form-control" min="0" max="100" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Lowest in Class</label>
            <input type="number" name="lowest_in_class" class="form-control" min="0" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Highest in Class</label>
            <input type="number" name="highest_in_class" class="form-control" min="0" required>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Save Scores</button>
    </div>
</form>
@endsection