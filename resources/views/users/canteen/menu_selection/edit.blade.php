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
                        <h4 class="text-white fw-bold">Update  Menu Selection</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 ">
            <div class="card breadcome-bottom p-3">
                <form  action="{{route('menu_selection.update', $selection->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row mt-3 mb-3">
                        <div class="col-lg-8 offset-lg-2">
                            <h4 class="fw-bold text-primary text-center mb-3"> Menu Details</h4>
                            <h5 class="text-primary fw-bold mb-2  mt-3">Date :</h5>
                            <input type="date" name="day" required class="form-control" value="{{$selection->day}}">
                            @if ($errors->has('day'))
                                <span class="error text-danger">{{ $errors->first('day') }}</span>
                            @endif
                            
                            <h5 class="text-primary fw-bold mb-2  mt-3">Menu  :</h5>
                            <select name="menu_master_id" class="form-control" required>
                                <option value="">Select Menu</option>
                                @forelse($masters as $master)
                                 <option value="{{$master->id}}" {{ (($selection->menu_master_id) == ($master->id)) ? 'selected' :''; }}>{{$master->name}}</option>
                                @empty
                                @endforelse
                            </select>
                            @if ($errors->has('menu_master_id'))
                                <span class="error text-danger">{{ $errors->first('menu_master_id') }}</span>
                            @endif
                            
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