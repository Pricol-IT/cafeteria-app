@extends('layouts.app')
@section('title')
    {{__('Today Over all Count')}}
@endsection
@section('main')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
          <div class="breadcome-list">
            <div class="row p-3">
              <div class="col-lg-6">
                <h4 class="text-white fw-bold">Todays Count</h4>
              </div>
              <div class="col-lg-6 text-lg-end">
                    <h3 class="text-white">{{ convertWDateFormat(date('Y-m-d')) }}</h3>
                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
            <div class="card breadcome-bottom p-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table datatable" >
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Emp ID</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">SP Meal</th>
                                  <th scope="col">SI Meal</th>
                                  <th scope="col">CURD</th>
                                </tr>
                              </thead>
                              <tbody>
                                
                                @php
                                    $totalEmpId = 0;
                                    $totalSpm = 0;
                                    $totalSim = 0;
                                    $totalCurd = 0;
                                @endphp

                                @forelse ($results as $result)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $result->emp_id }}</td>
                                        <td>{{ $result->name }}</td>
                                        <td>{{ $result->spm }}</td>
                                        <td>{{ $result->sim }}</td>
                                        <td>{{ $result->curd }}</td>
                                    </tr>

                                    @php
                                        // Update total values
                                        $totalEmpId += (int)$result->emp_id;
                                        $totalSpm += (int)$result->spm;
                                        $totalSim += (int)$result->sim;
                                        $totalCurd += (int)$result->curd;
                                    @endphp

                                @empty
                                    <tr>
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
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card p-3  rounded text-center">
                <h5 class="text-primary fw-bold">Special Meal</h5>
                <h3 class="text-primary">{{$totalSpm}}</h3>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-3  rounded text-center">
                <h5 class="text-primary fw-bold">South Indian</h5>
                <h3 class="text-primary">{{$totalSim}}</h3>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-3  rounded text-center">
                <h5 class="text-primary fw-bold">Curd</h5>
                <h3 class="text-primary">{{$totalCurd}}</h3>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script type="text/javascript" src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>


<!-- Your existing table code -->



@endsection