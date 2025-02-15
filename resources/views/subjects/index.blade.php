@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Subjects List</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
            Add Subject
        </button>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Subject Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->name }}</td>

                    <td>
                        <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                   
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add Subject Modal -->
    <div class="modal fade" id="addSubjectModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('subjects.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Subject</h5>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" class="form-control" 
                               placeholder="Subject Name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection