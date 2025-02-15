@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Scores for {{ $student->name }}</h2>
    
    <form method="POST" action="{{ route('scores.update', [$student, $score]) }}">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <!-- Subject Selection -->
            <div class="col-md-3">
                <label class="form-label">Subject</label>
                <select name="subject_id" class="form-select" required>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" 
                            {{ $score->subject_id == $subject->id ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- CA and Exam Scores -->
            <div class="col-md-2">
                <label class="form-label">CA1</label>
                <input type="number" name="ca1" class="form-control" 
                       value="{{ old('ca1', $score->ca1) }}" min="0" max="30" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">CA2</label>
                <input type="number" name="ca2" class="form-control" 
                       value="{{ old('ca2', $score->ca2) }}" min="0" max="30" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">CA3</label>
                <input type="number" name="ca3" class="form-control" 
                       value="{{ old('ca3', $score->ca3) }}" min="0" max="30" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Exam</label>
                <input type="number" name="exam" class="form-control" 
                       value="{{ old('exam', $score->exam) }}" min="0" max="70" required>
            </div>

            <!-- Additional Fields -->
            <div class="col-md-3">
                <label class="form-label">Position in Subject</label>
                <input type="number" name="position_in_subject" class="form-control" 
                       value="{{ old('position_in_subject', $score->position_in_subject) }}" min="1" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Class Average (%)</label>
                <input type="number" step="0.01" name="class_average" class="form-control" 
                       value="{{ old('class_average', $score->class_average) }}" min="0" max="100" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Lowest in Class</label>
                <input type="number" name="lowest_in_class" class="form-control" 
                       value="{{ old('lowest_in_class', $score->lowest_in_class) }}" min="0" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Highest in Class</label>
                <input type="number" name="highest_in_class" class="form-control" 
                       value="{{ old('highest_in_class', $score->highest_in_class) }}" min="0" required>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update Scores</button>
            <a href="{{ route('students.show', $student) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection