@extends('layouts.app')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Parent List (Total: {{ $getRecord->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="{{ url('admin/parent/add') }}" class="btn btn-primary">Add New Parent</a>
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
                                <h2 class="card-title">Search Parent</h2>
                            </div>
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label>Name</label>
                                            <input type="text" class="form-control" value="{{ Request::get('name') }}"
                                                name="name" placeholder="Name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control"
                                                value="{{ Request::get('last_name') }}" name="last_name"
                                                placeholder="Last Name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Email</label>
                                            <input type="text" class="form-control" value="{{ Request::get('email') }}"
                                                name="email" placeholder="Email">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Mobile Number</label>
                                            <input type="text" class="form-control"
                                                value="{{ Request::get('mobile_number') }}" name="mobile_number"
                                                placeholder="Mobile Number">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Occupation</label>
                                            <input type="text" class="form-control"
                                                value="{{ Request::get('occupation') }}" name="occupation"
                                                placeholder="Occupation">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Address</label>
                                            <input type="text" class="form-control" value="{{ Request::get('address') }}"
                                                name="address" placeholder="Address">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender">
                                                <option value="">Select Gender</option>
                                                <option {{ Request::get('gender') == 'male' ? 'selected' : '' }}
                                                    value="male">
                                                    Male
                                                </option>
                                                <option {{ Request::get('gender') == 'female' ? 'selected' : '' }}
                                                    value="female">
                                                    Female</option>
                                                <option {{ Request::get('gender') == 'other' ? 'selected' : '' }}
                                                    value="other">
                                                    Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="">Select Status</option>
                                                <option {{ Request::get('status') == 0 ? 'selected' : '' }} value="0">
                                                    Active
                                                </option>
                                                <option {{ Request::get('status') == 1 ? 'selected' : '' }} value="1">
                                                    Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Date</label>
                                            <input type="date" class="form-control" value="{{ Request::get('date') }}"
                                                name="date">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <button class="btn btn-primary" type="submit"
                                                style="margin-top:32px;">Search</button>
                                            <a href="{{ url('admin/parent/list') }}" class="btn btn-success"
                                                style="margin-top:32px;">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @include('_message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Parent List</h3>
                                <form style="float:right;" action="{{ url('admin/parent/export_excel') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ Request::get('name') }}">
                                    <input type="hidden" name="last_name" value="{{ Request::get('last_name') }}">
                                    <input type="hidden" name="email" value="{{ Request::get('email') }}">
                                    <input type="hidden" name="gender" value="{{ Request::get('gender') }}">
                                    <input type="hidden" name="occupation" value="{{ Request::get('occupation') }}">
                                    <input type="hidden" name="address" value="{{ Request::get('address') }}">
                                    <input type="hidden" name="mobile_number"
                                        value="{{ Request::get('mobile_number') }}">
                                    <input type="hidden" name="status" value="{{ Request::get('status') }}">
                                    <input type="hidden" name="date" value="{{ Request::get('date') }}">
                                    <button class="btn btn-primary btn-sm">Export Excel</button>
                                </form>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="overflow:auto;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Last Name</th>
                                            <th>Profile Pic</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Mobile Number</th>
                                            <th>Occupation</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->last_name }}</td>
                                                <td>
                                                    @if (!empty($value->getProfileDirect()))
                                                        <img src="{{ $value->getProfileDirect() }}"
                                                            style="height:50px;width:50px;border-radius:50%;"
                                                            alt="">
                                                    @endif
                                                </td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->gender }}</td>
                                                <td>{{ $value->mobile_number }}</td>
                                                <td>{{ $value->occupation }}</td>
                                                <td>{{ $value->address }}</td>
                                                <td>
                                                    {{ $value->status == 0 ? 'Active' : 'Inactive' }}
                                                </td>


                                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                <td style="min-width:290px;">
                                                    <a href="{{ url('admin/parent/edit/' . $value->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="fas fa-pen"></i></a>
                                                    <a href="{{ url('admin/parent/delete/' . $value->id) }}"
                                                        class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    <a href="{{ url('admin/parent/my-student/' . $value->id) }}"
                                                        class="btn btn-primary btn-sm">My Student</a>
                                                    <a href="{{ url('chat?receiver_id=' . base64_encode($value->id)) }}"
                                                        class="btn btn-success btn-sm">Send Message</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
