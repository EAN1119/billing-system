@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Account</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ url('/accounts/'.$account->id) }}" enctype="multipart/form-data" method="post" class="form-horizontal">
                        @csrf
                        @method('PATCH')
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"><strong>Bil. Acc. ID</strong></label>
                                <div class="col-md-6 mt-2">
                                    <div class="line-up-form">{{ str_pad($account->id, 6, '0', STR_PAD_LEFT) }}</div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"><strong>Account Number</strong></label>
                                <div class="col-md-6 mt-2">
                                    <div class="line-up-form">{{ $account->account_no }}</div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right mt-2"><strong>Company Name</strong></label>
                                <div class="col-md-6 mt-2">
                                    <input id="company_name" type="text" class="line-up-form form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ $account->company_name }}" required autocomplete="company_name" autofocus>
                                    <!-- can add 'required' before 'autocomplete' -->
                                    @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"><strong>Created By</strong></label>
                                <div class="col-md-6 mt-2">
                                    <div class="line-up-form">{{ $account->created_by }}</div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"><strong>Created At</strong></label>
                                <div class="col-md-6 mt-2">
                                    <div class="line-up-form">{{ $account->created_at }}</div>
                                </div>

                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-md-4"></div>

                                <div class="col-md-6 mt-2">
                                    <button type="submit" class="btn btn-success">Update Account</button>
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
