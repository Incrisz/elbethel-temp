@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Students List</h1>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add New Student</a>
    </div>

    <form action="{{ route('students.index') }}" method="GET" class="mb-3">
        <div class="input-group" style="width: 350px;">
            <input type="text" name="search" class="form-control" placeholder="Search by Name or Class"
                   value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">Search</button>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ADM No</th>
                <th>Name</th>
                <th>Class</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->adm_no }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->class }}</td>
                    <td>
                        <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('sbs.edit', $student) }}" class="btn btn-sm btn-danger">SB</a>
                        <a href="{{ route('scores.create', $student) }}" class="btn btn-sm btn-success">Add Scores</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
