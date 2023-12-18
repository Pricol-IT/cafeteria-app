@extends('layouts.app')
@section('title')
    {{__('Dashboard')}}
@endsection
@section('main')
<main id="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h2 class="text-primary text-center p-2 fw-bold">Special Meal - Delivery</h2>
            </div>
        </div>

        <form action="{{route('canteen.deliverySpm')}}" method="get">
            @csrf
            @method('get')
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="bg-white p-3 shadow">
                        <div class="row">
                            <div class="col-lg-8">
                                <input type="text" class="form-control mt-2 border border-primary" name="emp_id" autocomplete="off">
                            </div>
                            <div class="col-lg-4">
                              <center>
                                  <button class="btn btn-primary  mt-2"> Search</button>
                                <a href="{{route('canteen.deliverySpm')}}" class="btn  mt-2 btn-danger">Reset</a> 
                              </center>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            </form>
          @if($forcheck == 'true')

            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="bg-white p-3 shadow">
                        <form action="{{route('canteen.deliverystore')}}" method="post">
                           @csrf
                           @method('POST') 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card p-3 bg-primary">
                                    @foreach($user_id as $user)

                                    <div class="d-flex justify-content-between">
                                        <div class="text-white fw-bold "><h4>Date : {{date('d-m-Y');}}</h4></div>
                                        <div class="text-white fw-bold "><h4>ID : {{$user->emp_id}}</h4></div>
                                        <div class="text-white fw-bold "><h4>Name : {{$user->name}}</h4></div>
                                        <input type="hidden" name="emp_id" value="{{$user->id}}">
                                    </div>
                                    @endforeach
                                    <input type="hidden" name="day"  value="{{date('Y-m-d'); }}">
                                    <input type="hidden" name="spm"  value="{{$result['spm'] }}">
                                    <input type="hidden" name="curd"  value="{{$result['curd'] }}">
                                    <input type="hidden" name="page" value="canteen.deliverySpm">

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="text-white  bg-primary  fw-bold card pt-2 p-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="fw-bold">Special Meal </h4> 
                                        <h1 class=" text-white fw-bold ">x {{$result['spm'] ? $result['spm'] : 0 }}</h1>
                                    </div>
                                    
                                </div>
                                
                                <div class="text-white bg-primary  fw-bold card pt-2 p-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="fw-bold">Curd </h4> 
                                        <h1 class=" text-white fw-bold ">x {{$result['curd'] ? $result['curd'] : 0 }}</h1>
                                    </div>
                                    
                                </div>
                                <!-- <div class="text-primary card fw-bold p-3"><h4 class="fw-bold"> <span class="text-white fw-bold badge bg-primary text-right">{{$result['spm']}}</span></h4></div>
                                <div class="text-primary card fw-bold p-3"><h4 class="fw-bold">Curd <span class="text-white fw-bold badge bg-primary text-right">{{$result['spm']}}</span></h4></div> -->
                            </div>
                            
                            <div class="col-lg-12">
                                <center>
                                    <input type="submit" name="submit" value="Deliver" class="btn btn-primary">
                                <a href="{{route('canteen.deliverySpm')}}" class="btn btn-danger">Back</a>
                                </center>
                                
                            </div>
                        </div>
                           
                        </form>
                    </div>
                </div>
            </div>
        @endif
        

        <!--     -->
    </div>
  </main><!-- End #main -->
@endsection