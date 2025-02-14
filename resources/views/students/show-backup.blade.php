@extends('layouts.app')

@section('content')
    <div class="report-header text-center mb-4">
        <h1>EL-BETHEL ACADEMY</h1>
        <p>Off Bida Road, Zakka Village, Gbaganu Minna, Niger State</p>
        <h3>END OF TERM REPORT</h3>
    </div>

    <div class="student-info mb-4">
        <h2>{{ $student->name }}</h2>
        <p>ADM No: {{ $student->adm_no }} | Class: {{ $student->class }}</p>
        <p>Days Present: {{ $student->no_of_days_present }}</p>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Subject</th>
                <th>CA1</th>
                <th>CA2</th>
                <th>CA3</th>
                <th>Exam</th>
                <th>Total</th>
                <th>Grade</th>
                <th>Position</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student->scores as $score)
                <tr>
                    <td>{{ $score->subject->name }}</td>
                    <td>{{ $score->ca1 }}</td>
                    <td>{{ $score->ca2 }}</td>
                    <td>{{ $score->ca3 }}</td>
                    <td>{{ $score->exam }}</td>
                    <td>{{ $score->total_marks }}</td>
                    <td>{{ $score->grade }}</td>
                    <td>{{ $score->position_in_subject }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="skills-section mt-4">
        <h4>Skills & Behavior</h4>
        <div class="row">
            @if($student->sb)
                <div class="col-md-4">
                    <p>Attentiveness: {{ $student->sb->attentiveness }}/5</p>
                    <p>Perseverance: {{ $student->sb->perseverance }}/5</p>
                </div>
                <div class="col-md-4">
                    <p>Communication: {{ $student->sb->communication_skills }}/5</p>
                    <p>Handwriting: {{ $student->sb->handwriting }}/5</p>
                </div>
                <div class="col-md-4">
                    <p>Politeness: {{ $student->sb->politeness }}/5</p>
                    <p>Self Control: {{ $student->sb->self_control }}/5</p>
                </div>
            @endif
        </div>
    </div>

    <div class="comments-section mt-4">
        <h4>Teacher's Comments</h4>
        <p>{{ $student->teacher_comments }}</p>
    </div>

@endsection