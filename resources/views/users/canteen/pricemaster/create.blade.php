@extends('layouts.app')
@section('title')
    {{__('Create Price')}}
@endsection
@section('main')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcome-list">
                <div class="row p-3">
                    <div class="col-lg-6">
                        <h4 class="text-white fw-bold">Create New Price</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 ">
            <div class="card breadcome-bottom p-3">
               
                <form  action="{{route('price_master.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="row mt-3 mb-3">
                        <div class="col-lg-8 offset-lg-2">
                            <h4 class="fw-bold text-primary text-center mb-3"> Price Details</h4>
                            <h5 class="text-primary fw-bold mb-2  mt-3">Code :</h5>
                            <input type="text" name="code" class="form-control" value="{{old('code')}}">
                            @if ($errors->has('code'))
                                <span class="error text-danger">{{ $errors->first('code') }}</span>
                            @endif
                            <h5 class="text-primary fw-bold mb-2  mt-3">Menu Type :</h5>
                            <input type="text" name="menu_type" class="form-control" value="{{old('menu_type')}}">
                            @if ($errors->has('menu_type'))
                                <span class="error text-danger">{{ $errors->first('menu_type') }}</span>
                            @endif
                            <h5 class="text-primary fw-bold mb-2  mt-3">Quantity :</h5>
                            <input type="text" name="quantity" class="form-control" value="{{old('quantity')}}">
                            @if ($errors->has('quantity'))
                                <span class="error text-danger">{{ $errors->first('quantity') }}</span>
                            @endif
                            <h5 class="text-primary fw-bold mb-2  mt-3">Price :</h5>
                            <input type="text" name="price" class="form-control" value="{{old('price')}}">
                            @if ($errors->has('price'))
                                <span class="error text-danger">{{ $errors->first('price') }}</span>
                            @endif
                            <h5 class="text-primary fw-bold mb-2  mt-3">Validity Start Date :</h5>
                            <input type="date" name="start_date" class="form-control" value="{{old('start_date')}}">
                            @if ($errors->has('start_date'))
                                <span class="error text-danger">{{ $errors->first('start_date') }}</span>
                            @endif
                            <h5 class="text-primary fw-bold mb-2  mt-3">Validity End Date :</h5>
                            <input type="date" name="end_date" class="form-control" value="{{old('end_date')}}">
                            @if ($errors->has('end_date'))
                                <span class="error text-danger">{{ $errors->first('end_date') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <center>
                            <input type="submit" name="submit" value="Save" class="btn btn-primary">
                            <a href="{{route('price_master.index')}}" class="btn btn-danger">Back</a>
                        </center>
                    </div>
                    
                </form>
                
            </div>
        </div>
    </div>
  </main><!-- End #main -->
@endsection