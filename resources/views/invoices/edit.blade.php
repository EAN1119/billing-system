@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Invoice</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ url('/invoices/'.$invoice->id) }}" enctype="multipart/form-data" method="post" class="form-horizontal">
                        @csrf
                        @method('PATCH')
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
                                    <input id="total_paid" type="number" min="0" max="{{ $invoice->total_price }}" step=".01" value="{{ $invoice->total_paid }}" name="total_paid" required autofocus/>
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

                                <div class="col-md-6 mt-2">
                                    <button type="submit" class="btn btn-success">Update Invoice</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
