@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Invoice</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    <fieldset>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Invoice ID</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Bil. Acc. ID</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ str_pad($invoice->account_id, 6, '0', STR_PAD_LEFT) }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Invoice Number</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $invoice->invoice_no }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Invoice Date</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $invoice->invoice_date }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Order ID</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ str_pad($invoice->order_id, 6, '0', STR_PAD_LEFT) }}</div>
                            </div>

                        </div>                       
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Payment Terms</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $invoice->payment_terms }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Total Price</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $invoice->total_price }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Total Paid</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $invoice->total_paid }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Total Unpaid</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $invoice->total_unpaid }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Order Created By</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $invoice->created_by }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Created At</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $invoice->created_at }}</div>
                            </div>

                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>

                            <div class="col-md-6 mt-2 d-flex flex-row">
                                <a href="{{ url('/invoices/'.$invoice->id.'/edit') }}" type="button" class="btn btn-primary mr-5">Edit</a>

                                <form action="{{ url('/invoices/'.$invoice->id) }}" enctype="multipart/form-data" method="post" class="form-horizontal">
                                    @csrf
                                    @method('DELETE')
                                    <div class="ml-5">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </fieldset>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
