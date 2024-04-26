@extends('layouts.app')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Student Dashboard</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ number_format($TotalPaidAmount, 2) }}TK</h3>

                                <p>Total Paid Amount</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ url('student/fees_collection') }}" class="small-box-footer">More
                                info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $TotalSubject }}</h3>

                                <p>Total Subject</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-table"></i>
                            </div>
                            <a href="{{ url('student/my_subject') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $TotalNoticeBoard }}</h3>

                                <p>Notice Board</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-table"></i>
                            </div>
                            <a href="{{ url('student/my_notice_board') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $TotalHomework }}</h3>

                                <p>Total Homework</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-table"></i>
                            </div>
                            <a href="{{ url('student/my_homework') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $TotalSubmittedHomework }}</h3>

                                <p>Total Submitted Homework</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-table"></i>
                            </div>
                            <a href="{{ url('student/my_submitted_homework') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $TotalAttendance }}</h3>

                                <p>Total Attendance</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-table"></i>
                            </div>
                            <a href="{{ url('student/my_attendance') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
