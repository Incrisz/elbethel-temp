@extends('layouts.app')

@section('content')

<form method="POST" action="{{ $action }}">
    @csrf
    @isset($class) @method('PUT') @endisset

    <div class="mb-3">
        <label>Level Name (e.g., JSS1, SS2)</label>
        <input type="text" name="name" class="form-control" 
               value="{{ old('name', $class->name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Class Arm (e.g., A, B, Science)</label>
        <input type="text" name="arm" class="form-control" 
               value="{{ old('arm', $class->arm ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Next Class (for promotion)</label>
        <select name="next_class_id" class="form-select">
            <option value="">-- Select Next Class --</option>
            @foreach($classes as $c)
                <option value="{{ $c->id }}" 
                    {{ old('next_class_id', $class->next_class_id ?? '') == $c->id ? 'selected' : '' }}>
                    {{ $c->name }} {{ $c->arm }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Save Class</button>
</form>
@endsection