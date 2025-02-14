@extends('layouts.app')

@section('content')
    <h1>Behavior Ratings for {{ $student->name }}</h1>
    
    <form action="{{ route('sbs.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            @foreach(['attentiveness', 'perseverance', 'promptness', 'communication_skills', 
                    'handwriting', 'punctuality', 'neatness', 'politeness', 'honesty', 'self_control'] as $field)
                <div class="col-md-4 mb-3">
                    <label>{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                    <select name="{{ $field }}" class="form-select" required>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ optional($student->sb)[$field] == $i ? 'selected' : '' }}>
                                {{ $i }} ({{ ['Poor', 'Fair', 'Satisfactory', 'Very Good', 'Excellent'][$i-1] }})
                            </option>
                        @endfor
                    </select>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Save Ratings</button>
        <a href="{{ route('students.show', $student) }}" class="btn btn-secondary">Cancel</a>

    </form>
@endsection