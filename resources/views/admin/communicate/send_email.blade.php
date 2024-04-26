@extends('layouts.app')


@section('style')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/css/select2.min.css">
    <style>
        .select2-container .select2-selection--single {
            height: 40px;
        }
    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Send Email</h1>
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
                            <form method="post" action="">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="name" name="subject" class="form-control" placeholder="Subject">
                                    </div>
                                    <div class="form-group">
                                        <label>User (Student / Parent / Teacher)</label>
                                        <select name="user_id" class="form-control" id="select2" style="width:100%;">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label style="display:block;">Message To</label>
                                        <label style="margin-right:50px;"><input type="checkbox" value="3"
                                                name="message_to[]">Student</label>
                                        <label style="margin-right:50px;"><input type="checkbox" value="4"
                                                name="message_to[]">Parent</label>
                                        <label><input type="checkbox" value="2" name="message_to[]">Teacher</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea name="message" id="compose-textarea" class="form-control"></textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Send Email</button>
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

@section('script')
    <script src="{{ asset('admin') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     $('#select2').select2({
        //         minimumInputLength: 2,
        //         cache: true,
        //         placeholder: 'Search for a user....',
        //         ajax: {
        //             url: "{{ url('admin/communicate/search_user') }}",
        //             dataType: 'json',
        //             type: "GET",
        //             delay: 250,
        //             data: function(data) {
        //                 return {
        //                     search: data.term,
        //                 };
        //             },
        //             precessResults: function(response) {
        //                 return {
        //                     results: response
        //                 };
        //             },

        //         }
        //     });
        // });
        $(document).ready(function() {
            $('#select2').select2({
                ajax: {
                    url: "{{ url('admin/communicate/search_user') }}",
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type: 'user_search'
                        };
                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        }
                    }
                },
                cache: true,
                placeholder: 'Search for a user....',
                minimumInputLength: 1
            });
        });
        $(function() {
            $('#compose-textarea').summernote({
                height: 200,
            });

        });
    </script>
@endsection
