<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('style.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <!-- <p>Welcome to</p> -->
    <h1>EL-BETHEL ACADEMY</h1>
    <p>Off Bida Road, Zakka Village, Gbaganu Minna, Niger State</p>

    <div class="table-data">
        <table class="table-one" border="1px">
            <tr>
                <td><img src="{{ asset('logo.jpeg')}}" alt="logo" srcset=""></td>
                <td  colspan="3">END OF TERM REPORT, next term <br /> begins:2025-01-06|Term End:2025-07-27</td>
                <td  colspan="2">Admission No.:{{ $student->adm_no }} <br /> Name:{{ $student->name }} <br /> Gender:{{ $student->gender }} Class:{{ $student->class }}</td>
                <td rowspan="2"><img src="{{ asset('passport.jpeg')}}" width="120px" height="140px" alt=""></td>
            </tr>

            <tr>
                <td>Session:2024/2025</td>
                <td>Term:First <br> Term</td>
                <td>Report Date:22nd, January <br> 2025</td>
                <td>No of Days <br> Present:{{ $student->no_of_days_present }}</td>
                <td>No of Days <br> Absent:NIL</td>
                <td>No in Class: {{ $student->no_in_class }}</td>

            </tr>
            
        </table>

        <table class="table-two" border="1px">
            <tr>
                <th>SUBJECTS</th>
                <th>CA1</th>
                <th>CA2</th>
                <th>CA3</th>
                <th>EXAM</th>
                <th>TOTAL <br /> MARKS</th>
                <th>GRADE</th>
                <th>POSITION IN <br /> SUBJECTS</th>
                <th>CLASS <br /> AVERAGE</th>
                <th>LOWEST <br /> IN CLASS</th>
                <th>HIGHEST <br /> IN CLASS</th>
            </tr>
            @foreach($student->scores as $score)
                <tr>
                    <th>{{ $score->subject->name }}</th>
                    <td>{{ $score->ca1 }}</td>
                    <td>{{ $score->ca2 }}</td>
                    <td>{{ $score->ca3 }}</td>
                    <td>{{ $score->exam }}</td>
                    <td>{{ $score->total_marks }}</td>
                    <td>{{ $score->grade }}</td>
                    <td>{{ $score->position_in_subject }}</td>
                    <td>{{ $score->class_average }}</td>
                    <td>{{ $score->lowest_in_class }}</td>
                    <td>{{ $score->highest_in_class }}</td>
                </tr>
            @endforeach
        </table>

        <table class="table-three" border="1px">
            <tr>
                <td colspan="2"><b>Grading System:</b>75 += A1(Distinction) <br />  70-74 = B2, 65-69 = B3 <br />
                (Very Good), 60-64 = C4, 55-59 = C5, <br />
            50-54 = C6 (Credit), 45-49 = D7, 40-44 = E8(Pass), <br /> 0-39 = F9 (Fail)</td>
                <td style="text-align: center;">Skills and Behaviour</td>
                <td colspan="3"><b>KEYS TO RATINGS:</b>Excellent = 5, <br /> Very Good = 4, Satisfactory = 3, Fair = 2, Poor = 1</td>
            </tr>

            <tr>
                <td colspan="2"><b>Class Teacher Comments:</b>  {{ $student->teacher_comments }} </td>
                <td>Attentiveness</td>
                <td class="four">{{ $student->skillsbehavior->attentiveness }}</td>
                <td rowspan="10"><img src="{{ asset('Signature.jpg') }}"  alt="" srcset=""></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td>Perseverance</td>
                <td class="four">{{ $student->skillsbehavior->perseverance }}</td>
            </tr>

            <tr>
                <td class="print">Principal's Comment:</td>
                <td></td>
                <td>Promptness in completing work</td>
                <td class="four">{{ $student->skillsbehavior->promptness }}</td>
            </tr>

            <tr>
                <td class="print"></td>
                <td></td>
                <td>Communication Skills</td>
                <td class="four">{{ $student->skillsbehavior->communication_skills }}</td>
            </tr>

            <tr>
                <td class="print"></td>
                <td></td>
                <td>Handwriting</td>
                <td class="four">{{ $student->skillsbehavior->handwriting }}</td>
            </tr>

            <tr>
                <td class="print">Marks <br /> Obtainable:{{ $student->marks_obtainable }}</td>
                <td></td>
                <td>Punctuality</td>
                <td class="four">{{ $student->skillsbehavior->punctuality }}</td>
            </tr>

            <tr>
                <td class="print">Marks Obtainable:{{ $student->marks_obtained }}</td>
                <td></td>
                <td>Neatness</td>
                <td class="four">{{ $student->skillsbehavior->neatness }}</td>
            </tr>

            <tr>
                <td class="print">Average:{{ $student->average }}</td>
                <td></td>
                <td>Politeness</td>
                <td class="four">{{ $student->skillsbehavior->politeness }}</td>
            </tr>

            <tr>
                <td class="print">Position: {{ $student->position }}</td>
                <td></td>
                <td>Honesty</td>
                <td class="four">{{ $student->skillsbehavior->honesty }}</td>
            </tr>

            <tr>
                <td class="print"> </td>
                <td></td>
                <td>Self Control</td>
                <td class="four">{{ $student->skillsbehavior->self_control }}</td>
            </tr>
        </table>
        <button id="print-button" onclick="window.print()">Print</button>
        <button id="print-button" ><a href="{{ route('students.index') }}">Back</a></button>

    </div>

</body>
</html>