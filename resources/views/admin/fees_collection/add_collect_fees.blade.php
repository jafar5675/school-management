@extends('layouts.app')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Fees Collection <span style="color:blue;">({{ $getStudent->name }}
                                {{ $getStudent->last_name }})</span></h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <button type="button" class="btn btn-success" id="AddFees">Add Fees</button>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('_message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Payment Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Class Name</th>
                                            <th>Total Amount</th>
                                            <th>Paid Amount</th>
                                            <th>Remaining Amount</th>
                                            <th>Payment Type</th>
                                            <th>Remark</th>
                                            <th>Created By</th>
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @if (!empty($getRecord)) --}}
                                        @forelse ($getFees as $value)
                                            <tr>
                                                <td>{{ $value->class_name }}</td>
                                                <td>${{ number_format($value->total_amount, 2) }}</td>
                                                <td>${{ number_format($value->paid_amount, 2) }}</td>
                                                <td>${{ number_format($value->remaining_amount, 2) }}</td>
                                                <td> {{ $value->payment_type }}</td>
                                                <td>{{ $value->remark }}</td>
                                                <td>{{ $value->created_name }}</td>
                                                <td>{{ date('d-m-Y H: i A', strtotime($value->created_at)) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="100%">Record not Found</td>
                                            </tr>
                                        @endforelse
                                        {{-- @endif --}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{-- <ul class="pagination pagination-sm m-0 float-right">
                                    @if (!empty($getRecord))
                                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                    @endif
                                </ul> --}}
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

    <div class="modal fade" id="AddFeesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Fees</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">Class Name: {{ $getStudent->class_name }}</label>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Total Amount:
                                ${{ number_format($getStudent->amount, 2) }}</label>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Paid
                                Amount: ${{ number_format($paid_amount, 2) }}</label>
                        </div>
                        <div class="mb-3">
                            @php
                                $RemainingAmount = $getStudent->amount - $paid_amount;
                            @endphp
                            <label class="col-form-label">Remaining Amount: ${{ number_format($RemainingAmount) }}</label>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Amount</label>
                            <input type="text" class="form-control" name="amount">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Payment Type</label>
                            <select name="payment_type" class="form-control">
                                <option value="">Select</option>
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                                <option value="stripe">Stripe</option>
                                <option value="paypal">Paypal</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Remark</label>
                            <textarea class="form-control" name="remark"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#AddFees').click(function() {
            $('#AddFeesModal').modal('show');
        });
    </script>
@endsection
