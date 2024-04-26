@extends('layouts.app')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Notice Board</h1>
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
                            <form method="post" action="">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="name" name="title" class="form-control"
                                            value="{{ $getRecord->title }}" placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label>Notice Date</label>
                                        <input type="date" name="notice_date" class="form-control"
                                            value="{{ $getRecord->notice_date }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Publish Date</label>
                                        <input type="date" name="publish_date" class="form-control"
                                            value="{{ $getRecord->publish_date }}">
                                    </div>
                                    @php
                                        $message_to_student = $getRecord->getMessageToSingle($getRecord->id, 3);
                                        $message_to_parent = $getRecord->getMessageToSingle($getRecord->id, 4);
                                        $message_to_teacher = $getRecord->getMessageToSingle($getRecord->id, 2);
                                    @endphp
                                    <div class="form-group">
                                        <label style="display:block;">Message To</label>
                                        <label style="margin-right:50px;"><input
                                                {{ !empty($message_to_student) ? 'checked' : '' }} type="checkbox"
                                                value="3" name="message_to[]">Student</label>
                                        <label style="margin-right:50px;"><input
                                                {{ !empty($message_to_parent) ? 'checked' : '' }} type="checkbox"
                                                value="4" name="message_to[]">Parent</label>
                                        <label><input {{ !empty($message_to_teacher) ? 'checked' : '' }} type="checkbox"
                                                value="2" name="message_to[]">Teacher</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea name="message" id="compose-textarea" class="form-control">{{ $getRecord->message }}</textarea>
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

@section('script')
    <script>
        $(function() {
            $('#compose-textarea').summernote()
        });
    </script>
@endsection
