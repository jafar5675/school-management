@extends('layouts.app')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Homework Report </h1>
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
                                <h2 class="card-title">Search Homework Report</h2>
                            </div>
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label>Student First Name</label>
                                            <input type="text" class="form-control"
                                                value="{{ Request::get('first_name') }}" name="first_name"
                                                placeholder="Student First Name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Student Last Name</label>
                                            <input type="text" class="form-control"
                                                value="{{ Request::get('last_name') }}" name="last_name"
                                                placeholder="Student Last Name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Class</label>
                                            <input type="text" class="form-control"
                                                value="{{ Request::get('class_name') }}" name="class_name"
                                                placeholder="Class Name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Subject</label>
                                            <input type="text" class="form-control"
                                                value="{{ Request::get('subject_name') }}" name="subject_name"
                                                placeholder="Subject Name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Home workdate From</label>
                                            <input type="date" class="form-control"
                                                value="{{ Request::get('homework_date_from') }}" name="homework_date_from">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Home workdate To</label>
                                            <input type="date" class="form-control"
                                                value="{{ Request::get('homework_date_to') }}" name="homework_date_to">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Submissiondate From</label>
                                            <input type="date" class="form-control"
                                                value="{{ Request::get('submission_date_from') }}"
                                                name="submission_date_from">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Submissiondate To</label>
                                            <input type="date" class="form-control"
                                                value="{{ Request::get('submission_date_to') }}" name="submission_date_to">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Submitted date From</label>
                                            <input type="date" class="form-control"
                                                value="{{ Request::get('created_date_from') }}" name="created_date_from">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Submitted date To</label>
                                            <input type="date" class="form-control"
                                                value="{{ Request::get('created_date_to') }}" name="created_date_to">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <button class="btn btn-primary" type="submit"
                                                style="margin-top:32px;">Search</button>
                                            <a href="{{ url('admin/homework/homework_report') }}" class="btn btn-success"
                                                style="margin-top:32px;">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @include('_message')
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Homework Report</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Student Name</th>
                                                <th>Class</th>
                                                <th>Subject</th>
                                                <th>Homework</th>
                                                <th>Submission</th>
                                                <th>Document</th>
                                                <th>Description</th>
                                                <th>Created Date</th>
                                                <th>Submitted Document</th>
                                                <th>Submitted Description</th>
                                                <th>Submitted Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($getRecord as $value)
                                                <tr>
                                                    <td>{{ $value->id }}</td>
                                                    <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                    <td>{{ $value->class_name }}</td>
                                                    <td>{{ $value->subject_name }}</td>
                                                    <td>{{ date('d-m-Y H:i A', strtotime($value->getHomework->homework_date)) }}
                                                    </td>
                                                    <td>{{ date('d-m-Y H:i A', strtotime($value->getHomework->submission_date)) }}
                                                    </td>
                                                    <td>
                                                        @if (!empty($value->getHomework->getDocument()))
                                                            <a href="{{ $value->getHomework->getDocument() }}"
                                                                class="btn btn-primary btn-sm" download="">Download</a>
                                                        @endif
                                                    </td>
                                                    <td>{!! $value->getHomework->description !!}</td>
                                                    <td>{{ date('d-m-Y H:i A', strtotime($value->getHomework->created_at)) }}
                                                    </td>
                                                    <td>
                                                        @if (!empty($value->getDocument()))
                                                            <a href="{{ $value->getDocument() }}"
                                                                class="btn btn-primary btn-sm" download="">Download</a>
                                                        @endif
                                                    </td>
                                                    <td>{!! $value->description !!}</td>
                                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>Record not Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                    </ul>
                                </div>
                            </div>
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
