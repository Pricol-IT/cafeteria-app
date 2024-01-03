@extends('layouts.app')
@section('title')
    {{__('Reports')}}
@endsection
@section('main')
<main id="main" class="main">
    
    <div class="row">
        <div class="col-lg-12">
          <div class="breadcome-list">
            <div class="row p-3">
              <div class="col-lg-6">
                <h4 class="text-white fw-bold">Reports</h4>
              </div>
              <div class="col-lg-6 text-lg-end">
                @if (request('from_date') || request('to_date') || request('status'))
                    <a href="{{ route('user.userReport') }}" class="btn btn-danger"><i
                            class="fas fa-times"></i>&nbsp; {{ __('Reset') }}
                    </a>
                @endif
                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
            <div class="card breadcome-bottom p-3">
                <form action="{{route('user.userReport')}}" method="get" onchange="this.submit();">
                @csrf
                @method('GET')  
                <div class="row">
                    
                    <div class="col-lg-4 ">
                        <label>From Date</label>
                        <input type="date" class="form-control" name="from_date" value="{{ request('from_date') }}">
                    </div>
                    <div class="col-lg-4 ">
                        <label>To Date</label>
                        <input type="date" class="form-control" name="to_date" value="{{ request('to_date') }}">
                    </div>
                    <div class="col-lg-4 ">
                        <label>Status</label>
                        <!-- <input type="listv" name="status">
                        <datalist id="listv">
                            <option>Select</option>
                        </datalist> -->
                        <select class="form-control" name="status">

                            <option value="" {{request('status') == '' ? 'selected' : '' }}>All</option>
                            <option value="1" {{request('status') == 1 ? 'selected' : '' }}>Delivered</option>
                            <option value="0" {{((request('status') == 0) && (request('status') != '')) ? 'selected' : '' }}>Not delivered</option>
                        </select>
                    </div>
                </div>
                <br>
                </form>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table datatable">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Date</th>
                                  <th scope="col">SP Meal</th>
                                  <th scope="col">SI Meal</th>
                                  <th scope="col" >CURD</th>
                                  <th>Status</th>
                                </tr>
                                
                              </thead>
                              <tbody>
                                @php
                                    $totalrsp = 0;
                                    $totalrsi = 0;
                                    $totalrcurd = 0;
                                @endphp

                                @forelse ($reports as $rfid)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ convertDateFormat($rfid['day']) }}</td>
                                        <td>{{ $rfid->spm}}</td>
                                        <td>{{ $rfid->sim}}</td>
                                        <td>{{ $rfid->curd }}</td>
                                        <td>
                                            @if($rfid->status == 0)
                                            <p class="text-danger">Not delivered</p>
                                            @else
                                            <p class="text-success">Delivered</p>
                                            @endif
                                        </td>
                                    </tr>

                                    @php
                                        
                                        

                                        $totalrsp += (int)$rfid->spm;
                                        $totalrsi += (int)$rfid->sim;
                                        $totalrcurd += (int)$rfid->curd;
                                    @endphp

                                @empty
                                    <tr> 
                                        <td></td>
                                        <td colspan="6"> No Data Found</td>
                                    </tr>
                                @endforelse
                                
                              </tbody>
                            </table>
                            <h6 class="fw-bold text-primary"><span class="">Note: </span><br> 1. Selected menu will be updated at 10.05 AM and Delivery Status will be updated at 3.30 PM on respective date.<br>
                            </h6>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card p-3  rounded text-center">
                <h5 class="text-primary fw-bold">Special Meal</h5>
                <h3 class="text-primary">{{$totalrsp}}</h3>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-3  rounded text-center">
                <h5 class="text-primary fw-bold">South Indian</h5>
                <h3 class="text-primary">{{$totalrsi}}</h3>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-3  rounded text-center">
                <h5 class="text-primary fw-bold">Curd</h5>
                <h3 class="text-primary">{{$totalrcurd}}</h3>
            </div>
        </div>
    </div>
</main>
@endsection