@extends('admin.layouts.app')
@section('title')
    {{__('Create User')}}
@endsection
@section('main')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
          <div class="breadcome-list">
            <div class="row p-3">
              <div class="col-lg-6">
                <h4 class="text-white fw-bold">User Details</h4>
              </div>
              <div class="col-lg-6 text-lg-end">
                <!-- <a href="{{route('user.create')}}" class="btn btn-light round">Add User</a> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
            <div class="card breadcome-bottom p-4">
                <form method="post" action="{{route('user.store')}}">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-6 col-md-6 pt-2 pb-2">
                            <label>Plant (Company Name)</label>
                            <input type="text" name="company_name" class="form-control" value="{{old('company_name')}}">
                            @if ($errors->has('company_name'))
                              <span class="error text-danger">{{ $errors->first('company_name') }}</span>
                          @endif
                        </div>
                        <div class="col-lg-6 col-md-6 pt-2 pb-2">
                            <label>Employee Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}">
                            @if ($errors->has('name'))
                              <span class="error text-danger">{{ $errors->first('name') }}</span>
                          @endif
                        </div>
                        <div class="col-lg-6 col-md-6 pt-2 pb-2">
                            <label>Emp ID </label>
                            <input type="text" name="emp_id" class="form-control" value="{{old('emp_id')}}">
                            @if ($errors->has('emp_id'))
                              <span class="error text-danger">{{ $errors->first('emp_id') }}</span>
                          @endif
                        </div>
                        <div class="col-lg-6 col-md-6 pt-2 pb-2">
                            <label>RFID</label>
                            <input type="number" min='0' name="rfid" class="form-control" value="{{old('rfid')}}">
                            @if ($errors->has('rfid'))
                              <span class="error text-danger">{{ $errors->first('rfid') }}</span>
                          @endif
                        </div>
                        <div class="col-lg-6 col-md-6 pt-2 pb-2">
                            <label>Email ID</label>
                            <input type="email" name="email" class="form-control" value="{{old('email')}}">
                            @if ($errors->has('email'))
                              <span class="error text-danger">{{ $errors->first('email') }}</span>
                          @endif
                        </div>
                        <div class="col-lg-6 col-md-6 pt-2 pb-2">
                            <label>Location</label>
                            <input type="text" name="location" class="form-control" value="{{old('location')}}">
                            @if ($errors->has('location'))
                              <span class="error text-danger">{{ $errors->first('location') }}</span>
                          @endif
                        </div>
                        <div class="col-lg-6 col-md-6 pt-2 pb-2">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="{{old('password')}}">
                            @if ($errors->has('password'))
                              <span class="error text-danger">{{ $errors->first('password') }}</span>
                          @endif
                        </div>
                        <div class="col-lg-6 col-md-6 pt-2 pb-2">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" value="{{old('password_confirmation')}}">
                            @if ($errors->has('password_confirmation'))
                              <span class="error text-danger">{{ $errors->first('password_confirmation') }}</span>
                          @endif
                        </div>
                        <div class="col-lg-12 pt-2 pb-2">
                            <center><input type="submit" name="submit" value="Save" class="btn btn-primary">
                            <a href="{{route('user.index')}}" class="btn btn-danger">Back</a>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </main><!-- End #main -->
@endsection