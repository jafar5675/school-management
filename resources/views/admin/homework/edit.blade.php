@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Homework</h1>
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
                                    <div class="form-group">
                                        <label>Class<span style="color:red;">*</span></label>
                                        <select name="class_id" id="getClass" class="form-control" required>
                                            <option value="">Select Class</option>
                                            @foreach ($getClass as $class)
                                                <option {{ $getRecord->class_id == $class->id ? 'selected' : '' }}
                                                    value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Subject<span style="color:red;">*</span></label>
                                        <select name="subject_id" id="getSubject" class="form-control" required>
                                            <option value="">Select Subject</option>
                                            @foreach ($getSubject as $subject)
                                                <option
                                                    {{ $getRecord->subject_id == $subject->subject_id ? 'selected' : '' }}
                                                    value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Homework Date<span style="color:red;">*</span></label>
                                        <input type="date" value="{{ $getRecord->homework_date }}" name="homework_date"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Submission Date<span style="color:red;">*</span></label>
                                        <input type="date" value="{{ $getRecord->submission_date }}"
                                            name="submission_date" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Document</label>
                                        <input type="file" name="document_file" class="form-control">
                                        @if (!empty($getRecord->getDocument()))
                                            <a href="{{ $getRecord->getDocument() }}" class="btn btn-primary"
                                                download="">Download</a>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Description<span style="color:red;">*</span></label>
                                        <textarea name="description" id="compose-textarea" class="form-control">{{ $getRecord->description }}</textarea>
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
            $('#compose-textarea').summernote({
                height: 200,
            });

            $('#getClass').change(function() {
                var class_id = $(this).val();
                $.ajax({
                    type: "post",
                    url: "{{ url('admin/ajax_get_subject') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        class_id: class_id,
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#getSubject').html(data.success);
                    }
                });
            });
        });
    </script>
@endsection
