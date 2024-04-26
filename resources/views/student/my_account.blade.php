@extends('layouts.app')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Account</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @include('_message')
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
                                                class="form-control" required placeholder="First Name">
                                            <div style="color:red">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name<span style="color:red;">*</span></label>
                                            <input type="name" name="last_name"
                                                value="{{ old('last_name', $getRecord->last_name) }}" class="form-control"
                                                required placeholder="Last Name">
                                            <div style="color:red">{{ $errors->first('last_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Gender<span style="color:red;">*</span></label>
                                            <select class="form-control" required name="gender">
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
                                            <label>Date of Birth<span style="color:red;">*</span></label>
                                            <input type="date" name="date_of_birth"
                                                value="{{ old('date_of_birth', $getRecord->date_of_birth) }}"
                                                class="form-control" required placeholder="Date of Birth">
                                            <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Caste</label>
                                            <input type="text" name="caste"
                                                value="{{ old('caste', $getRecord->caste) }}" class="form-control"
                                                placeholder="Caste">
                                            <div style="color:red">{{ $errors->first('caste') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Religion</label>
                                            <input type="text" name="religion"
                                                value="{{ old('religion', $getRecord->religion) }}" class="form-control"
                                                placeholder="Religion">
                                            <div style="color:red">{{ $errors->first('religion') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Mobile Number</label>
                                            <input type="name" name="mobile_number"
                                                value="{{ old('mobile_number', $getRecord->mobile_number) }}"
                                                class="form-control" placeholder="Mobile Number">
                                            <div style="color:red">{{ $errors->first('mobile_number') }}</div>
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
                                            <label>Blood Group<span style="color:red;">*</span></label>
                                            <input type="text" name="blood_group"
                                                value="{{ old('blood_group', $getRecord->blood_group) }}"
                                                class="form-control" placeholder="Blood Group">
                                            <div style="color:red">{{ $errors->first('blood_group') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Height<span style="color:red;"></span></label>
                                            <input type="text" name="height"
                                                value="{{ old('height', $getRecord->height) }}" class="form-control"
                                                placeholder="Height">
                                            <div style="color:red">{{ $errors->first('height') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Weight<span style="color:red;"></span></label>
                                            <input type="text" name="weight"
                                                value="{{ old('weight', $getRecord->weight) }}" class="form-control"
                                                placeholder="Weight">
                                            <div style="color:red">{{ $errors->first('weight') }}</div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label>Email<span style="color:red;">*</span></label>
                                        <input type="email" name="email"
                                            value="{{ old('email', $getRecord->email) }}" class="form-control" required
                                            placeholder="Email">
                                        <div style="color:red">{{ $errors->first('email') }}</div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
