@extends('layouts.app')

@section('content')
    <h1>Add New Student</h1>
    
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label>Gender</label>
                <select name="gender" class="form-select" required>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            
            <div class="col-md-4">
                <label>ADM Number</label>
                <input type="text" name="adm_no" class="form-control" value="{{ old('adm_no') }}" required>
            </div>

            <div class="col-md-4">
                <label>Class</label>
                <input type="text" name="class" class="form-control" value="{{ old('class') }}" required>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label>Days Present</label>
                <input type="number" name="no_of_days_present" class="form-control" 
                       value="{{ old('no_of_days_present') }}" required>
            </div>
        </div>
        <div class="col-md-4">
            <label>Marks Obtainable</label>
            <input type="number" name="marks_obtainable" class="form-control" 
                value="{{ old('marks_obtainable') }}" required>
        </div>

        <div class="col-md-4">
            <label>Marks Obtained</label>
            <input type="number" name="marks_obtained" class="form-control" 
                value="{{ old('marks_obtained') }}" required>
        </div>

        <div class="col-md-4">
            <label>Position</label>
            <input type="text" name="position" class="form-control" 
                value="{{ old('position') }}">
        </div>    
        
        <div class="col-md-4">
            <label>session</label>
            <input type="text" name="session" class="form-control" 
                value="{{ old('session') }}">
        </div>

        <div class="col-md-4">
            <label>term</label>
            <input type="text" name="term" class="form-control" 
                value="{{ old('term') }}">
        </div>
        <div class="col-md-4">
            <label>No in Class</label>
            <input type="text" name="no_in_class" class="form-control" 
                value="{{ old('no_in_class') }}">
        </div>

        <div class="mb-3">
            <label>Teacher Comments</label>
            <textarea name="teacher_comments" class="form-control">{{ old('teacher_comments') }}</textarea>
        </div>  <div class="mb-3">
            <label>Principal Comments</label>
            <textarea name="principal_comments" class="form-control">{{ old('principal_comments') }}</textarea>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Save Student</button>
        </div>
    </form>
@endsection