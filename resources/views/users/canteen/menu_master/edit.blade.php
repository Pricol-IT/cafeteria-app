@extends('layouts.app')
@section('title')
    {{__('Edit Menu Master')}}
@endsection
@section('main')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcome-list">
                <div class="row p-3">
                    <div class="col-lg-6">
                        <h4 class="text-white fw-bold">Update  Menu</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 ">
            <div class="card breadcome-bottom p-3">
               
                <form  action="{{route('menu_master.update', $master->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row mt-3 mb-3">
                        <div class="col-lg-8 offset-lg-2">
                            <h4 class="fw-bold text-primary text-center mb-3"> Menu Details</h4>
                            <h5 class="text-primary fw-bold mb-2  mt-3">Menu Name :</h5>
                            <input type="text" name="name" class="form-control" value="{{$master->name}}">
                            @if ($errors->has('name'))
                                <span class="error text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            
                            <h5 class="text-primary fw-bold mb-2  mt-3">Menu Descriptions :</h5>
                            <textarea class="form-control" name="description">{{$master->description}}</textarea>
                            @if ($errors->has('description'))
                                <span class="error text-danger">{{ $errors->first('description') }}</span>
                            @endif
                            <h5 class="text-primary fw-bold mb-2  mt-3">Menu Image :</h5>
                            <input type="file" name="image" class="form-control" accept="image/png,image/jpeg,image/jpg" >
                            @error('image')
                                <span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <center>
                            <input type="submit" name="submit" value="Save" class="btn btn-primary">
                            <a href="{{route('menu_master.index')}}" class="btn btn-danger">Back</a>
                        </center>
                    </div>
                    
                </form>
                
            </div>
        </div>
    </div>
  </main><!-- End #main -->
@endsection