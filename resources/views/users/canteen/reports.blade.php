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
                    <a href="{{ route('canteen.reports') }}" class="btn btn-danger"><i
                            class="fas fa-times"></i>&nbsp; {{ __('Reset') }}
                    </a>
                @endif
                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
            <div class="card breadcome-bottom p-3">
                <form action="{{route('canteen.reports')}}" method="get" onchange="this.submit();">
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
                                  <th></th>
                                  <th scope="col">SI Meal</th>
                                  <th></th>
                                  <th scope="col" >CURD</th>
                                  <th></th>
                                </tr>
                                
                              </thead>
                              <tbody>
                                <tr>
                                  <td scope="col"></td>
                                  <td scope="col"></td>
                                  <td scope="col">Booked</td>
                                  <td scope="col">Delivery</td>
                                  <td scope="col">Booked</td>
                                  <td scope="col">Delivery</td>
                                  <td scope="col">Booked</td>
                                  <td scope="col">Delivery</td>
                                </tr>
                                @php
                                    $totalrsp = 0;
                                    $totaldsp = 0;
                                    $totalrsi = 0;
                                    $totaldsi = 0;
                                    $totalrcurd = 0;
                                    $totaldcurd = 0;
                                @endphp

                                @forelse ($combinedData as $rfid)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ convertDateFormat($rfid['day']) }}</td>
                                        <td>{{ $rfid['rfid_spm']}}</td>
                                        <td>{{ $rfid['delivery_spm']}}</td>
                                        <td>{{ $rfid['rfid_sim']}}</td>
                                        <td>{{ $rfid['delivery_sim']}}</td>
                                        <td>{{ $rfid['rfid_curd'] }}</td>
                                        <td>{{ $rfid['delivery_curd']}}</td>
                                    </tr>

                                    @php
                                        
                                        

                                        $totalrsp += (int)$rfid['rfid_spm'];
                                        $totaldsp += (int)$rfid['delivery_spm'];
                                        $totalrsi += (int)$rfid['rfid_sim'];
                                        $totaldsi += (int)$rfid['delivery_sim'];
                                        $totalrcurd += (int)$rfid['rfid_curd'];
                                        $totaldcurd += (int)$rfid['delivery_curd'];
                                    @endphp

                                @empty
                                    <tr> 
                                        <td></td>
                                        <td colspan="8"> No Data Found</td>
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
                            <td>Booked</td>
                            <td>Delivered</td>
                        </tr>
                        <tr>
                            <td><h5 class="text-primary">Special Meals</h5></td>
                            <td>{{$totalrsp}}</td>
                            <td>{{$totaldsp}}</td>
                        </tr>
                        <tr>
                            <td><h5 class="text-primary">South Indian</h5></td>
                            <td>{{$totalrsi}}</td>
                            <td>{{$totaldsi}}</td>
                        </tr>
                        <tr>
                            <td><h5 class="text-primary">Curd</h5></td>
                            <td>{{$totalrcurd}}</td>
                            <td>{{$totaldcurd}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</main>
@endsection