@extends('layouts.app')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Exam Timetable </h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($getRecord as $value)
                            <h2>{{ $value['class_name'] }}</h2>
                            @foreach ($value['exam'] as $exam)
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            {{ $exam['exam_name'] }}
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Subject Name</th>
                                                    <th>Day</th>
                                                    <th>Exam Date</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Room Number</th>
                                                    <th>Full Marks</th>
                                                    <th>Passing Marks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($exam['subject'] as $valueS)
                                                    <tr>
                                                        <td>{{ $valueS['subject_name'] }}</td>
                                                        <td>{{ date('l', strtotime($valueS['exam_date'])) }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($valueS['exam_date'])) }}</td>
                                                        <td>{{ date('h:i A', strtotime($valueS['start_time'])) }}</td>
                                                        <td>{{ date('h:i A', strtotime($valueS['end_time'])) }}</td>
                                                        <td>{{ $valueS['room_number'] }}</td>
                                                        <td>{{ $valueS['full_marks'] }}</td>
                                                        <td>{{ $valueS['passing_marks'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach


                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- /.row -->
                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
