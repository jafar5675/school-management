@extends('layouts.app')

@section('style')
    <style>
        .bmar {
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Marks Register </h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Search Marks Register</h2>
                            </div>
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Exam</label>
                                            <select name="exam_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($getExam as $exam)
                                                    <option
                                                        {{ Request::get('exam_id') == $exam->exam_id ? 'selected' : '' }}
                                                        value="{{ $exam->exam_id }}">{{ $exam->exam_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Class</label>
                                            <select name="class_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($getClass as $class)
                                                    <option
                                                        {{ Request::get('class_id') == $class->class_id ? 'selected' : '' }}
                                                        value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit"
                                                style="margin-top:32px;">Search</button>
                                            <a href="{{ url('teacher/marks_register') }}" class="btn btn-success"
                                                style="margin-top:32px;">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @include('_message')
                        @if (!empty($getSubject) && !empty($getSubject->count()))
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Marks Register</h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                @foreach ($getSubject as $subject)
                                                    <th>
                                                        {{ $subject->subject_name }}<br />
                                                        ({{ $subject->subject_type }}:{{ $subject->full_marks }}/{{ $subject->passing_marks }})
                                                    </th>
                                                @endforeach
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($getStudent) && !empty($getStudent->count()))
                                                @foreach ($getStudent as $student)
                                                    <form class="submitForm" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="student_id"
                                                            value="{{ $student->id }}">
                                                        <input type="hidden" name="exam_id"
                                                            value="{{ Request::get('exam_id') }}">
                                                        <input type="hidden" name="class_id"
                                                            value="{{ Request::get('class_id') }}">
                                                        <tr>
                                                            <td>{{ $student->name }} {{ $student->last_name }}
                                                            </td>
                                                            @php
                                                                $i = 1;
                                                                $totalStudentMark = 0;
                                                                $totalFullMarks = 0;
                                                                $totalPassingMarks = 0;
                                                                $pass_fail_vali = 0;
                                                            @endphp
                                                            @foreach ($getSubject as $subject)
                                                                @php
                                                                    $totalMark = 0;
                                                                    $totalFullMarks =
                                                                        $totalFullMarks + $subject->full_marks;
                                                                    $totalPassingMarks =
                                                                        $totalPassingMarks + $subject->passing_marks;
                                                                    $getMark = $subject->getMark(
                                                                        $student->id,
                                                                        Request::get('exam_id'),
                                                                        Request::get('class_id'),
                                                                        $subject->subject_id,
                                                                    );
                                                                    // dd($getMark);
                                                                    if (!empty($getMark)) {
                                                                        $totalMark =
                                                                            $getMark->class_work +
                                                                            $getMark->home_work +
                                                                            $getMark->test_work +
                                                                            $getMark->exam;
                                                                    }

                                                                    $totalStudentMark = $totalStudentMark + $totalMark;
                                                                @endphp
                                                                <td>
                                                                    <div class="bmar">
                                                                        Class work
                                                                        <input type="hidden"
                                                                            name="mark[{{ $i }}][full_marks]"
                                                                            value="{{ $subject->full_marks }}">
                                                                        <input type="hidden"
                                                                            name="mark[{{ $i }}][passing_marks]"
                                                                            value="{{ $subject->passing_marks }}">
                                                                        <input type="hidden"
                                                                            name="mark[{{ $i }}][id]"
                                                                            value="{{ $subject->id }}">
                                                                        <input type="hidden"
                                                                            name="mark[{{ $i }}][subject_id]"
                                                                            value="{{ $subject->subject_id }}">
                                                                        <input type="text"
                                                                            value="{{ !empty($getMark) ? $getMark->class_work : '' }}"
                                                                            name="mark[{{ $i }}][class_work]"
                                                                            id="class_work_{{ $student->id }}{{ $subject->subject_id }}"
                                                                            placeholder="Enter Marks" class="form-control">
                                                                    </div>
                                                                    <div class="bmar">
                                                                        Home work
                                                                        <input type="text"
                                                                            value="{{ !empty($getMark) ? $getMark->home_work : '' }}"
                                                                            name="mark[{{ $i }}][home_work]"
                                                                            id="home_work_{{ $student->id }}{{ $subject->subject_id }}"
                                                                            placeholder="Enter Marks" class="form-control">
                                                                    </div>
                                                                    <div class="bmar">
                                                                        Test work
                                                                        <input type="text"
                                                                            value="{{ !empty($getMark) ? $getMark->test_work : '' }}"
                                                                            name="mark[{{ $i }}][test_work]"
                                                                            id="test_work_{{ $student->id }}{{ $subject->subject_id }}"
                                                                            placeholder="Enter Marks" class="form-control">
                                                                    </div>
                                                                    <div class="bmar">
                                                                        Exam
                                                                        <input
                                                                            type="text"value="{{ !empty($getMark) ? $getMark->exam : '' }}"
                                                                            name="mark[{{ $i }}][exam]"
                                                                            id="exam_{{ $student->id }}{{ $subject->subject_id }}"
                                                                            placeholder="Enter Marks" class="form-control">
                                                                    </div>
                                                                    <div style="margin-bottom:10px;">
                                                                        <button type="button"
                                                                            class="btn btn-primary SaveSingleSubject"
                                                                            id="{{ $student->id }}"
                                                                            data-val="{{ $subject->subject_id }}"
                                                                            data-exam="{{ Request::get('exam_id') }}"
                                                                            data-schedule="{{ $subject->id }}"
                                                                            data-class="{{ Request::get('class_id') }}">Save</button>
                                                                    </div>
                                                                    @if (!empty($totalMark))
                                                                        <div style="margin-bottom:10px;">
                                                                            @php
                                                                                $getLoopGrade = App\Models\MarksGradeModel::getGrade(
                                                                                    $totalMark,
                                                                                );
                                                                            @endphp
                                                                            <b>Total Mark:{{ $totalMark }}</b><br />
                                                                            <b>Passing
                                                                                Mark:{{ $subject->passing_marks }}</b>
                                                                            @if (!empty($getLoopGrade))
                                                                                <b>Grade:</b>{{ $getLoopGrade }}<br>
                                                                            @endif
                                                                            @if ($totalMark >= $subject->passing_marks)
                                                                                <b>Result: </b> <span
                                                                                    style="color:green; font-Weight:bold;">Pass</span>
                                                                            @else
                                                                                <b>Result: </b> <span
                                                                                    style="color:red; font-Weight:bold;">Fail</span>
                                                                                @php
                                                                                    $pass_fail_vali = 1;
                                                                                @endphp
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach
                                                            <td style="min-width:220px;">
                                                                <button type="submit"
                                                                    class="btn btn-success btn-sm">Save</button>
                                                                <a class="btn btn-primary btn-sm" target="_blank"
                                                                    href="{{ url('teacher/my_exam_result/print?exam_id=' . Request::get('exam_id') . '&student_id=' . $student->id) }}">Print</a>
                                                                @if (!empty($totalStudentMark))
                                                                    <br>
                                                                    <b>Total Subject Mark:</b>
                                                                    {{ $totalFullMarks }}
                                                                    <br>
                                                                    <b>Total Passing Mark:</b>
                                                                    {{ $totalPassingMarks }}
                                                                    <br>
                                                                    <b>Total Student Mark:</b>
                                                                    {{ $totalStudentMark }}
                                                                    <br>
                                                                    @php
                                                                        $percentage =
                                                                            ($totalStudentMark * 100) / $totalFullMarks;
                                                                        $getGrade = App\Models\MarksGradeModel::getGrade(
                                                                            $percentage,
                                                                        );
                                                                    @endphp
                                                                    <b>Percentage:</b>{{ round($percentage, 2) }}%
                                                                    <br>
                                                                    @if (!empty($getGrade))
                                                                        <b>Grade:</b>{{ $getGrade }}
                                                                        <br>
                                                                    @endif
                                                                    @if ($pass_fail_vali == 0)
                                                                        <b>Result: </b><span
                                                                            style="color:green; font-Weight:bold;">Pass</span>
                                                                    @else
                                                                        <b>Result: </b><span
                                                                            style="color:red; font-Weight:bold;">Fail</span>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </form>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
    {{-- <script src="{{ asset('admin') }}/dist/fullCalendar/index.global.js"></script> --}}
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.submitForm').submit(function(e) {
            e.preventDefault();
            // var data = $(this).serialize();
            $.ajax({
                type: "post",
                url: "{{ url('teacher/submit_marks_register') }}",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    alert(data.message);
                }
            });
        });
        $('.SaveSingleSubject').click(function(e) {
            var student_id = $(this).attr('id');
            var subject_id = $(this).attr('data-val');
            var exam_id = $(this).attr('data-exam');
            var class_id = $(this).attr('data-class');
            var id = $(this).attr('data-schedule');
            var class_work = $('#class_work_' + student_id + subject_id).val();
            var home_work = $('#home_work_' + student_id + subject_id).val();
            var test_work = $('#test_work_' + student_id + subject_id).val();
            var exam = $('#exam_' + student_id + subject_id).val();

            $.ajax({
                type: "post",
                url: "{{ url('teacher/single_submit_marks_register') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    student_id: student_id,
                    subject_id: subject_id,
                    exam_id: exam_id,
                    class_id: class_id,
                    class_work: class_work,
                    home_work: home_work,
                    test_work: test_work,
                    exam: exam,
                },
                dataType: "json",
                success: function(data) {
                    alert(data.message);
                }
            });
        });
    </script>
@endsection
