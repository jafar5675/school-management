@extends('layouts.app')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Fees Collection </h1>
                    </div>
                    {{-- <div class="col-sm-6" style="text-align: right;">
                        <a href="{{ url('admin/fees_collection/collect_fees') }}" class="btn btn-primary">Add New Class</a>
                    </div> --}}
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
                                <h2 class="card-title">Search Class</h2>
                            </div>
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label>Class</label>
                                            <select name="class_id" class="form-control">
                                                <option value="">Select Class</option>
                                                @foreach ($getClass as $class)
                                                    <option {{ Request::get('class_id') == $class ? 'selected' : '' }}
                                                        value="{{ $class->id }}">
                                                        {{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Student Id</label>
                                            <input type="text" class="form-control"
                                                value="{{ Request::get('student_id') }}" name="student_id"
                                                placeholder="Student Id">
                                        </div>
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
                                            <button class="btn btn-primary" type="submit"
                                                style="margin-top:32px;">Search</button>
                                            <a href="{{ url('admin/fees_collection/collect_fees') }}"
                                                class="btn btn-success" style="margin-top:32px;">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @include('_message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Class List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Student Id</th>
                                            <th>Student Name</th>
                                            <th>Class Name</th>
                                            <th>Total Amount</th>
                                            <th>Paid Amount</th>
                                            <th>Remaining Amount</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($getRecord))
                                            @forelse ($getRecord as $value)
                                                @php
                                                    $paid_amount = $value->getPaidAmount($value->id, $value->class_id);
                                                    $RemainingAmount = $value->amount - $paid_amount;
                                                @endphp
                                                <tr>
                                                    <td>{{ $value->id }}</td>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ $value->class_name }}</td>
                                                    <td>${{ number_format($value->amount, 2) }}</td>
                                                    <td>${{ number_format($paid_amount, 2) }}</td>
                                                    <td>${{ number_format($RemainingAmount, 2) }}</td>
                                                    <td>{{ date('d-m-Y H: i A', strtotime($value->created_at)) }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/fees_collection/collect_fees/add_fees/' . $value->id) }}"
                                                            class="btn btn-primary">Collect Fees</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="100%">Record not Found</td>
                                                </tr>
                                            @endforelse
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    @if (!empty($getRecord))
                                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                    @endif
                                </ul>
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
