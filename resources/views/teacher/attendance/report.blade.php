@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Attendance Report <span style="color:blue">(Total:{{ $getRecord->total() }})</span></h1>
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
                                <h2 class="card-title">Search Attendance Report</h2>
                            </div>
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label>Stn Id</label>
                                            <input type="text" class="form-control" placeholder="Student Id"
                                                value="{{ Request::get('student_id') }}" name="student_id">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Stn Name</label>
                                            <input type="text" class="form-control" placeholder="Student Name"
                                                value="{{ Request::get('student_name') }}" name="student_name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Stn Last Name</label>
                                            <input type="text" class="form-control" placeholder="Stn Last Name"
                                                value="{{ Request::get('student_last_name') }}" name="student_last_name">
                                        </div>
                                        <div class="form-group col-md-2">
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
                                        <div class="form-group col-md-2">
                                            <label>Start Attendance Date</label>
                                            <input type="date" class="form-control"
                                                value="{{ Request::get('start_attendance_date') }}"
                                                name="start_attendance_date">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>End Attendance Date</label>
                                            <input type="date" class="form-control"
                                                value="{{ Request::get('end_attendance_date') }}"
                                                name="end_attendance_date">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Attendance Type</label>
                                            <select name="attendance_type" class="form-control">
                                                <option value="">Select</option>
                                                <option {{ Request::get('attendance_type') == 1 ? 'selected' : '' }}
                                                    value="1">Present</option>
                                                <option {{ Request::get('attendance_type') == 2 ? 'selected' : '' }}
                                                    value="2">Late</option>
                                                <option {{ Request::get('attendance_type') == 3 ? 'selected' : '' }}
                                                    value="3">Absent</option>
                                                <option {{ Request::get('attendance_type') == 4 ? 'selected' : '' }}
                                                    value="4">Half Day</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <button class="btn btn-primary" type="submit"
                                                style="margin-top:32px;">Search</button>
                                            <a href="{{ url('teacher/attendance/report') }}" class="btn btn-success"
                                                style="margin-top:32px;">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @include('_message')

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Attendance List</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Student Id</th>
                                            <th>Student Name</th>
                                            <th>Class Name</th>
                                            <th>Attendance Type</th>
                                            <th>Attendance Date</th>
                                            <th>Created By</th>
                                            <th>Current Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($getRecord))
                                            @forelse ($getRecord as $value)
                                                <tr>
                                                    <td>{{ $value->student_id }}</td>
                                                    <td>{{ $value->student_name }} {{ $value->student_last_name }}</td>
                                                    <td>{{ $value->class_name }}</td>
                                                    <td>
                                                        @if ($value->attendance_type == 1)
                                                            Present
                                                        @elseif ($value->attendance_type == 2)
                                                            Late
                                                        @elseif ($value->attendance_type == 3)
                                                            Absent
                                                        @elseif ($value->attendance_type == 4)
                                                            Half Day
                                                        @endif
                                                    </td>
                                                    <td>{{ date('d-m-Y', strtotime($value->attendance_date)) }}</td>
                                                    <td>{{ $value->created_name }}</td>
                                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="100%">Rocord not Found</td>
                                                </tr>
                                            @endforelse
                                        @else
                                            <tr>
                                                <td colspan="100%">Record not Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @if (!empty($getRecord))
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                    </ul>
                                </div>
                            @endif
                        </div>
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
