@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Subjects List</h1>
        <a href="{{ route('classes.create')}}" >

        <button class="btn btn-primary" >
            Add class

        </button>
</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Class</th>
                <th>Students</th>
                <th>Next Class</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $class)
            <tr>
                <td>{{ $class->name }} {{ $class->arm }}</td>
                <td>{{ $class->students_count }}</td>
                <td>{{ $class->nextClass->name ?? 'N/A' }} {{ $class->nextClass->arm ?? '' }}</td>
                <td>
                    <a href="{{ route('classes.edit', $class) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('classes.destroy', $class) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection