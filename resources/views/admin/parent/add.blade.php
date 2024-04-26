@extends('layouts.app')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New Parent</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">

                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>First Name<span style="color:red;">*</span></label>
                                            <input type="name" name="name" value="{{ old('name') }}"
                                                class="form-control" required placeholder="First Name">
                                            <div style="color:red">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name<span style="color:red;">*</span></label>
                                            <input type="name" name="last_name" value="{{ old('last_name') }}"
                                                class="form-control" required placeholder="Last Name">
                                            <div style="color:red">{{ $errors->first('last_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Gender</label>
                                            <input type="text" name="gender" value="{{ old('gender') }}"
                                                class="form-control" placeholder="Gender">
                                            <div style="color:red">{{ $errors->first('gender') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Ocupation</label>
                                            <input type="text" name="occupation" value="{{ old('occupation') }}"
                                                class="form-control" placeholder="Occupation">
                                            <div style="color:red">{{ $errors->first('occupation') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Mobile Number<span style="color:red;">*</span></label>
                                            <input type="name" name="mobile_number" value="{{ old('mobile_number') }}"
                                                class="form-control" placeholder="Mobile Number">
                                            <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Address</label>
                                            <input type="name" name="address" value="{{ old('address') }}"
                                                class="form-control" required placeholder="Address">
                                            <div style="color:red">{{ $errors->first('address') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Profile Pic<span style="color:red;">*</span></label>
                                            <input type="file" name="profile_pic" value="{{ old('profile_pic') }}"
                                                class="form-control">
                                            <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Status<span style="color:red;">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option {{ old('status') == 0 ? 'selected' : '' }} value="0">Active
                                                </option>
                                                <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Inactive
                                                </option>
                                            </select>
                                            <div style="color:red">{{ $errors->first('status') }}</div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label>Email<span style="color:red;">*</span></label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control" required placeholder="Email">
                                        <div style="color:red">{{ $errors->first('email') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Password<span style="color:red;">*</span></label>
                                        <input type="password" name="password" class="form-control" required
                                            placeholder="Password">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
