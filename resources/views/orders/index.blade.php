@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-row">
                    <div><strong>Orders</strong></div>
                    <div class="ml-auto"><strong><a href="{{ url('/orders/create') }}" class="text-decoration-none">&#10133;</a></strong></div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <!-- search -->
                    <form action="{{ url('/orders/search') }}" method="POST" role="search" class="mb-5">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="q"
                                   placeholder="Search for Bil. Acc. ID / Account Number / Company Name / Day of Week / Payment Terms / Invoice Number"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search">&#128269;</span>
                                </button>
                            </span>
                        </div>
                    </form>

                    
                    <!-- /search -->
                    
                    
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th></th>
                                <th>Order ID</th>
                                <th>Bil. Acc. ID</th>
                                <th>Acc. No.</th>
                                <th>Company Name</th>
                                <th>Desired Delivery Date</th>
                                <th>Day of Week</th>
                                <th>Payment Terms</th>
                                <th>Total Price</th>
                                <th>Tangibles</th>
                                <th>Invoice Number</th>                              
                            </tr>
                        </thead>
                       
                        
                    @if(count($orders) > 0)    
                        @foreach($orders as $order)
                        <tr>
                            <td><a href="{{ url('/orders/'.$order->id) }}">&#9989;</a></td>
                            <td>{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ str_pad($order->account_id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $order->account_no }}</td>
                            <td>{{ $order->company_name }}</td>
                            <td>{{ $order->delivery_date }}</td>
                            <td>{{ $order->day_of_week }}</td>
                            <td>{{ $order->payment_terms }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->items }}</td>   
                            <td>{{ $order->invoice_no }}</td>   
                            
                        </tr>
                        @endforeach
                        <div class="float-right">
                            {{$orders->links('pagination::bootstrap-4')}}   <!--for paging-->
                        </div>
                    @else
                    <span>No orders have been made</span>
                    @endif  
                    </table>  
                    
                    
  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
