@extends('layouts.app')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Students </h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        {{-- <a href="{{ url('admin/parent/add') }}" class="btn btn-primary">Add New Parent</a> --}}
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('_message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">My Students</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="overflow:auto;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile Pic</th>
                                            <th>Student Name</th>
                                            <th>Email</th>
                                            <th>Parent Name</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>
                                                    @if (!empty($value->getProfile()))
                                                        <img src="{{ $value->getProfile() }}"
                                                            style="height:50px;width:50px;border-radius:50%;"
                                                            alt="">
                                                    @endif
                                                </td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->parent_name }} {{ $value->parent_lastname }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                <td style="min-width:250px;">
                                                    <a style="margin-bottom: 10px;" class="btn btn-primary btn-sm"
                                                        href="{{ url('parent/my_student/subject/' . $value->id) }}">
                                                        Subject</a>
                                                    <a style="margin-bottom: 10px;" class="btn btn-success btn-sm"
                                                        href="{{ url('parent/my_student/exam_timetable/' . $value->id) }}">
                                                        Exam Timetable</a>
                                                    <a style="margin-bottom: 10px;" class="btn btn-primary btn-sm"
                                                        href="{{ url('parent/my_student/exam_result/' . $value->id) }}">
                                                        Exam Result</a>
                                                    <a style="margin-bottom: 10px;" class="btn btn-warning btn-sm"
                                                        href="{{ url('parent/my_student/calendar/' . $value->id) }}">
                                                        Calendar</a>
                                                    <a style="margin-bottom: 10px;" class="btn btn-primary btn-sm"
                                                        href="{{ url('parent/my_student/attendance/' . $value->id) }}">
                                                        Attendance</a>
                                                    <a style="margin-bottom: 10px;" class="btn btn-success btn-sm"
                                                        href="{{ url('parent/my_student/homework/' . $value->id) }}">
                                                        Homework</a>
                                                    <a style="margin-bottom: 10px;" class="btn btn-success btn-sm"
                                                        href="{{ url('parent/my_student/submitted_homework/' . $value->id) }}">
                                                        SubmittedHomework</a>
                                                    <a style="margin-bottom: 10px;" class="btn btn-primary btn-sm"
                                                        href="{{ url('parent/my_student/fees_collection/' . $value->id) }}">
                                                        Fees Collection</a>
                                                    <a style="margin-bottom: 10px;"
                                                        href="{{ url('chat?receiver_id=' . base64_encode($value->id)) }}"
                                                        class="btn btn-success btn-sm">Send Message</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
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
