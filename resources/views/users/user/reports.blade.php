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
                @if (request('from_date') || request('to_date'))
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
                    <div class="col-lg-4">&nbsp;</div>
                    <div class="col-lg-4 ">
                        <label>From Date</label>
                        <input type="date" class="form-control" name="from_date" value="{{ request('from_date') }}">
                    </div>
                    <div class="col-lg-4 ">
                        <label>To Date</label>
                        <input type="date" class="form-control" name="to_date" value="{{ request('to_date') }}">
                    </div>

                </div>
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
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="p-4">
                    <table width="100%">
                        <tr>
                            <td></td>
                            <td>Count</td>
                        </tr>
                        <tr>
                            <td><h5 class="text-primary">Special Meals</h5></td>
                            <td>{{$totalrsp}}</td>
                        </tr>
                        <tr>
                            <td><h5 class="text-primary">South Indian</h5></td>
                            <td>{{$totalrsi}}</td>
                        </tr>
                        <tr>
                            <td><h5 class="text-primary">Curd</h5></td>
                            <td>{{$totalrcurd}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</main>
@endsection