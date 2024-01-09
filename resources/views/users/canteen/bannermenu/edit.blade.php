@extends('layouts.app')
@section('title')
    {{__('Banner Menu')}}
@endsection
@section('main')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcome-list">
                <div class="row p-3">
                    <div class="col-lg-6">
                        <h4 class="text-white fw-bold">Edit Menu</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 ">
            <div class="card breadcome-bottom p-3">
                <form  action="{{route('banner_menu.update',$banner->id)}}" method="post" >
                    @csrf
                    @method('put')
                    <div class="row mt-3 mb-3">
                        <div class="col-lg-8 offset-lg-2">
                            <h4 class="fw-bold text-primary text-center mb-3"> Banner Menu Details</h4>
                            <h5 class="text-primary fw-bold mb-2  mt-3">Date Type :</h5>
                            <input type="text" name="day_type" class="form-control" value="{{ $banner->day_type}}">
                            @if ($errors->has('day_type'))
                                <span class="error text-danger">{{ $errors->first('day_type') }}</span>
                            @endif
                            <h5 class="text-primary fw-bold mb-2  mt-3">Date :</h5>
                            <input type="date" name="day" class="form-control" value="{{$banner->day}}">
                            @if ($errors->has('day'))
                                <span class="error text-danger">{{ $errors->first('day') }}</span>
                            @endif
                            
                        </div>
                    </div>
                    <div class="row">
                        <center>
                            <input type="submit" name="submit" value="Save" class="btn btn-primary">
                            <a href="{{route('banner_menu.index')}}" class="btn btn-danger">Back</a>
                        </center>
                    </div>
                    
                </form>
                
            </div>
        </div>
    </div>
  </main><!-- End #main -->
@endsection