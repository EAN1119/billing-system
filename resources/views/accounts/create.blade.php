@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Account</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ url('/accounts') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
                        @csrf
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right mt-2">Company Name</label>
                                <div class="col-md-6 mt-2">
                                    <input id="company_name" type="text" class="line-up-form form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>
                                    <!-- can add 'required' before 'autocomplete' -->
                                    @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>



                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-md-4"></div>

                                <div class="col-md-6 mt-2">
                                    <button type="submit" class="btn btn-success">Create Account</button>
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
