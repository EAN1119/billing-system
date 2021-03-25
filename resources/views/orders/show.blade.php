@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    <fieldset>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Order ID</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Bil. Acc. ID</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ str_pad($order->account_id, 6, '0', STR_PAD_LEFT) }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Account Number</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $order->account_no }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Company Name</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $order->company_name }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Delivery Date</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $order->delivery_date }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Day of Week</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $order->day_of_week }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Payment Terms</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $order->payment_terms }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Total Price</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $order->total_price }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Tangibles</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $order->items }}</div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"><strong>Invoice No</strong></label>
                            <div class="col-md-6 mt-2">
                                <div class="line-up-form">{{ $order->invoice_no }}</div>
                            </div>

                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>

                            <div class="col-md-6 mt-2 d-flex flex-row">
                                <a href="{{ url('/orders/'.$order->id.'/edit') }}" type="button" class="btn btn-primary mr-5">Edit</a>

                                <form action="{{ url('/orders/'.$order->id) }}" enctype="multipart/form-data" method="post" class="form-horizontal">
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
