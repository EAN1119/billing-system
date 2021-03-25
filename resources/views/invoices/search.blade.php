@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-row">
                    <div><strong>Invoices</strong></div>
                    
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- search -->
                    <form action="{{ url('/invoices/search') }}" method="POST" role="search" class="mb-5">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="q"
                                   placeholder="Search for Bil. Acc. ID / Invoice Number / Order ID / Order Created By"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search">&#128269;</span>
                                </button>
                            </span>
                        </div>
                    </form>

                    <div class="container">
                        @if(isset($details))
                        <p>Search results for '<strong>{{ $query }}</strong>':</p>

                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th></th>
                                    <th>Invoice ID</th>
                                    <th>Bil. Acc. ID</th>
                                    <th>Invoice Number</th>
                                    <th>Invoice Date</th>
                                    <th>Order ID</th>
                                    <th>Payment Terms</th>                               
                                    <th>Total Price</th>
                                    <th>Total Paid</th>
                                    <th>Total Unpaid</th>
                                    <th>Order Created By</th>
                                    <th>Created At</th>              
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details as $search_invoices)
                                <tr>
                                    <td><a href="{{ url('/invoices/'.$search_invoices->id) }}">&#9989;</a></td>
                                    <td>{{ str_pad($search_invoices->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ str_pad($search_invoices->account_id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $search_invoices->invoice_no }}</td>
                                    <td>{{ $search_invoices->invoice_date }}</td>
                                    <td>{{ str_pad($search_invoices->order_id, 6, '0', STR_PAD_LEFT) }}</td>                          
                                    <td>{{ $search_invoices->payment_terms }}</td>
                                    <td>{{ $search_invoices->total_price }}</td>
                                    <td>{{ $search_invoices->total_paid }}</td>   
                                    <td>{{ $search_invoices->total_unpaid }}</td>   
                                    <td>{{ $search_invoices->created_by }}</td>
                                    <td>{{ $search_invoices->created_at }}</td>   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <!-- /search -->






                </div>
            </div>
        </div>
    </div>
</div>
@endsection
