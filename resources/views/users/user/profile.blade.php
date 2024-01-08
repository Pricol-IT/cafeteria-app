@extends('layouts.app')
@section('title')
    {{__('Dashboard')}}
@endsection
@section('main')
<main id="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-3">
                    <div class="row mt-2 mb-2">
                        <div class="col-lg-12"><h3 class="text-primary fw-bold">{{ $user->name }} Details</h3></div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-lg-4"><h5 class="text-primary fw-bold">Name :</h5></div>
                        <div class="col-lg-8"><h6>{{ $user->name }}</h6></div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-lg-4"><h5 class="text-primary fw-bold">Plant (Company Name) :</h5></div>
                        <div class="col-lg-8"><h6>{{ $user->company_name }}</h6></div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-lg-4"><h5 class="text-primary fw-bold">Emp ID :</h5></div>
                        <div class="col-lg-8"><h6>{{ $user->emp_id }}</h6></div>
                    </div>
                    
                    <div class="row mt-2 mb-2">
                        <div class="col-lg-4"><h5 class="text-primary fw-bold">Email ID :</h5></div>
                        <div class="col-lg-8"><h6>{{ $user->email }}</h6></div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-lg-4"><h5 class="text-primary fw-bold">Location :</h5></div>
                        <div class="col-lg-8"><h6>{{ $user->location }}</h6></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <center><a href="{{route('user.transaction')}}" class="btn btn-danger">Back</a></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main><!-- End #main -->
@endsection