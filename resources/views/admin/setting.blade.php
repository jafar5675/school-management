@extends('layouts.app')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Setting</h1>
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
                        @include('_message')
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Paypal Business Email</label>
                                    <input type="email" name="paypal_email" value="{{ $getRecord->paypal_email }}"
                                        class="form-control" required placeholder="Paypal Business Email">
                                    <div style="color:red">{{ $errors->first('paypal_email') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Stripe Public Key</label>
                                    <input type="text" name="stripe_key" value="{{ $getRecord->stripe_key }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Stripe Secret Key</label>
                                    <input type="text" name="stripe_secret" value="{{ $getRecord->stripe_secret }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Logo<span style="color:red;"></span></label>
                                    <input type="file" class="form-control" name="logo">
                                    @if (!empty($getRecord->getLogo()))
                                        <img src="{{ $getRecord->getLogo() }}" style="width:auto;height:50px;">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Fevicon Icon<span style="color:red;"></span></label>
                                    <input type="file" class="form-control" name="favicon_icon">
                                    @if (!empty($getRecord->getFevicon()))
                                        <img src="{{ $getRecord->getFevicon() }}" style="width:auto;height:50px;">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>School Name</label>
                                    <input type="text" class="form-control" name="school_name"
                                        value="{{ $getRecord->school_name }}">
                                </div>
                                <div class="form-group">
                                    <label>Exam Description</label>
                                    <textarea class="form-control" name="exam_description">{{ $getRecord->exam_description }}</textarea>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
{{-- stripe key --}}
{{-- pk_test_51NIvrQDAdPN7SCZaRYNeo4PwCNR6QWtrCoObEEiRn3aF6xvprs9QqEIA1kPNWlGBrUIhEWj4UA4U8gVJR8pKdUyI00Mkg14zdP --}}
{{-- stripe secret --}}
{{-- sk_test_51NIvrQDAdPN7SCZapCdqMrqCqWyfattTCqgrHFP8mkTd4NYs7ZqNWZMycLB8CkDFroVk3BIqYKIGsy11WZdAc3H800t9X9GD8c --}}
