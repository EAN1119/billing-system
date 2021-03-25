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

                    <div class="container">
                        @if(isset($details))
                        <p>Search results for '<strong>{{ $query }}</strong>':</p>
                        
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
                            <tbody>
                                @foreach($details as $search_accounts)
                                <tr>
                                    <td><a href="{{ url('/accounts/'.$search_accounts->id) }}">&#9989;</a></td>
                                    <td>{{ str_pad($search_accounts->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $search_accounts->account_no }}</td>
                                    <td>{{ $search_accounts->company_name }}</td>
                                    <td>{{ $search_accounts->created_by }}</td>   
                                    <td>{{ $search_accounts->created_at }}</td>   
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
