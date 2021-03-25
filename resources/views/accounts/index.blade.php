@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-row">
                    <div><strong>Accounts</strong></div>
                    <div class="ml-auto"><strong><a href="{{ url('/accounts/create') }}" class="text-decoration-none">&#10133;</a></strong></div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- search -->
                    <form action="{{ url('/accounts/search') }}" method="POST" role="search" class="mb-5">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="q"
                                   placeholder="Search for Bil. Acc. ID / Account Number / Company Name / Created By"> <span class="input-group-btn">
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
                                <th>Bil. Acc. ID</th>
                                <th>Account Number</th>
                                <th>Company Name</th>
                                <th>Created By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>


                        @if(count($accounts) > 0)    
                        @foreach($accounts as $account)
                        <tr>
                            <td><a href="{{ url('/accounts/'.$account->id) }}">&#9989;</a></td>
                            <td>{{ str_pad($account->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $account->account_no }}</td>
                            <td>{{ $account->company_name }}</td>
                            <td>{{ $account->created_by }}</td>   
                            <td>{{ $account->created_at }}</td>   

                        </tr>
                        @endforeach
                        <div class="float-right">
                            {{$accounts->links('pagination::bootstrap-4')}}   <!--for paging-->
                        </div>
                        @else
                        <span>No accounts have been made</span>
                        @endif  
                    </table>  



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
