@extends('layouts.app')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Teacher</h1>
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
                                            <input type="name" name="name" value="{{ old('name', $getRecord->name) }}"
                                                class="form-control" placeholder="First Name">
                                            <div style="color:red">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name<span style="color:red;">*</span></label>
                                            <input type="name" name="last_name"
                                                value="{{ old('last_name', $getRecord->last_name) }}" class="form-control"
                                                placeholder="Last Name">
                                            <div style="color:red">{{ $errors->first('last_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Gender<span style="color:red;">*</span></label>
                                            <select class="form-control" name="gender">
                                                <option value="">Select Gender</option>
                                                <option {{ old('gender', $getRecord->gender) == 'male' ? 'selected' : '' }}
                                                    value="male">
                                                    Male
                                                </option>
                                                <option
                                                    {{ old('gender', $getRecord->gender) == 'female' ? 'selected' : '' }}
                                                    value="female">
                                                    Female</option>
                                                <option {{ old('gender', $getRecord->gender) == 'other' ? 'selected' : '' }}
                                                    value="other">
                                                    Other</option>
                                            </select>
                                            <div style="color:red">{{ $errors->first('gender') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Mobile Number</label>
                                            <input type="name" name="mobile_number"
                                                value="{{ old('mobile_number', $getRecord->mobile_number) }}"
                                                class="form-control" placeholder="Mobile Number">
                                            <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Date of Birth<span style="color:red;">*</span></label>
                                            <input type="date" name="date_of_birth"
                                                value="{{ old('date_of_birth', $getRecord->date_of_birth) }}"
                                                class="form-control" placeholder="Date_of_birth">
                                            <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Date of Joining<span style="color:red;">*</span></label>
                                            <input type="date" name="admission_date"
                                                value="{{ old('admission_date', $getRecord->admission_date) }}"
                                                class="form-control" placeholder="Admission_date">
                                            <div style="color:red">{{ $errors->first('admission_date') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Profile Pic<span style="color:red;">*</span></label>
                                            <input type="file" name="profile_pic" value="{{ old('profile_pic') }}"
                                                class="form-control">
                                            <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                                            @if (!empty($getRecord->getProfile()))
                                                <img src="{{ $getRecord->getProfile() }}" style="width:100px;"
                                                    alt="">
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Marital Status<span style="color:red;"></span></label>
                                            <input type="text" name="marital_status"
                                                value="{{ old('marital_status', $getRecord->marital_status) }}"
                                                class="form-control" placeholder="marital_status">
                                            <div style="color:red">{{ $errors->first('marital_status') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Current Address<span style="color:red;"></span></label>
                                            <textarea class="form-control" name="address">{{ old('address', $getRecord->address) }}</textarea>
                                            <div style="color:red">{{ $errors->first('address') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Permanent Address<span style="color:red;"></span></label>
                                            <textarea class="form-control" name="permanent_address">{{ old('permanent_address', $getRecord->permanent_address) }}</textarea>
                                            <div style="color:red">{{ $errors->first('permanent_address') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Qualification<span style="color:red;"></span></label>
                                            <textarea class="form-control" name="qualification">{{ old('qualification', $getRecord->qualification) }}</textarea>
                                            <div style="color:red">{{ $errors->first('qualification') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Work Experience<span style="color:red;"></span></label>
                                            <textarea class="form-control" name="experience">{{ old('experience', $getRecord->experience) }}</textarea>
                                            <div style="color:red">{{ $errors->first('experience') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Note<span style="color:red;"></span></label>
                                            <textarea class="form-control" name="note">{{ old('note', $getRecord->note) }}</textarea>
                                            <div style="color:red">{{ $errors->first('note') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Status<span style="color:red;">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option {{ old('status', $getRecord->status) == 0 ? 'selected' : '' }}
                                                    value="0">Active
                                                </option>
                                                <option {{ old('status', $getRecord->status) == 1 ? 'selected' : '' }}
                                                    value="1">Inactive
                                                </option>
                                            </select>
                                            <div style="color:red">{{ $errors->first('status') }}</div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label>Email<span style="color:red;">*</span></label>
                                        <input type="email" name="email"
                                            value="{{ old('email', $getRecord->email) }}" class="form-control"
                                            placeholder="Email">
                                        <div style="color:red">{{ $errors->first('email') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Password<span style="color:red;">*</span></label>
                                        <input type="password" name="password" class="form-control"
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
