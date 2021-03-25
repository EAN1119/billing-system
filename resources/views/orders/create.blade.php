@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Order</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ url('/orders') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
                        @csrf
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right mt-2">Billing Account ID</label>
                                <div class="col-md-6 mt-2">
                                    <input id="account_id" type="text" class="line-up-form form-control @error('account_id') is-invalid @enderror" name="account_id" value="{{ old('account_id') }}" required autocomplete="account_id" autofocus>
                                    <!-- can add 'required' before 'autocomplete' -->
                                    @error('account_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right mt-2">Delivery Date</label>
                                <div class="col-md-6 mt-2">
                                    <input id="delivery_date" type="date" class="line-up-form form-control @error('account_id') is-invalid @enderror" name="delivery_date" value="{{ old('delivery_date') }}" autocomplete="delivery_date" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Payment Terms</label>
                                <div class="col-md-6 mt-2">
                                    <select name="payment_terms" id="payment_terms">
                                        <option value="In Advance">In Advance</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Items</label>
                                <div class="col-md-6 mt-2">
                                    <label class="d-flex flex-row">
                                        <div>
                                            <input type="checkbox" name="items[]" value="Mineral 6L Bottled Water" id="mineral_6l"> Mineral 6L Bottled Water
                                        </div>
                                        <div class="ml-auto">
                                            <input type="number" id="quantity_mineral_6l" name="quantity_mineral_6l" min="1" max="500">
                                        </div>

                                    </label>
                                    <label class="d-flex flex-row">
                                        <div>
                                            <input type="checkbox" name="items[]" value="Mini Dispenser 6L" id="dispenser_6l"> Mini Dispenser 6L
                                        </div>
                                        <div class="ml-auto">
                                            <input type="number" id="quantity_dispenser_6l" name="quantity_dispenser_6l" min="1" max="500">
                                        </div>
                                        
                                    </label>
                                    <label class="d-flex flex-row">
                                        <div>
                                            <input type="checkbox" name="items[]" value="Mineral 1.5L Bottled Water" id="mineral_1_5l"> Mineral 1.5L Bottled Water
                                        </div>
                                        <div class="ml-auto">
                                            <input type="number" id="quantity_mineral_1_5l" name="quantity_mineral_1_5l" min="1" max="500">
                                        </div>
                                        
                                    </label>
                                    <label class="d-flex flex-row">
                                        <div>
                                            <input type="checkbox" name="items[]" value="Mineral 350ml Bottled Water" id="mineral_350ml"> Mineral 350ml Bottled Water
                                        </div>
                                        <div class="ml-auto">
                                            <input type="number" id="quantity_mineral_350ml" name="quantity_mineral_350ml" min="1" max="500">
                                        </div>
                                        
                                    </label>
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-md-4"></div>

                                <div class="col-md-6 mt-2">
                                    <button type="submit" class="btn btn-success">Create Order</button>
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
