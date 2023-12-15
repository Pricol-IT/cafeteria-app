@extends('layouts.app')
@section('title')
    {{__('Monthly Menu')}}
@endsection
@section('main')
<main id="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-2">
                    <div class="row">
                        <div class="col-lg-6"> <h3 class="fw-bold text-primary">Monthly Menu </h3></div>
                        <div class="col-lg-6 text-lg-end"><a href="{{route('user.monthlycreate')}}" class="btn btn-primary round">Select Menu</a></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table datatable">
                                  <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Date</th>
                                      <th scope="col">Menu</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    @forelse ($monthlys as $monthly)
                                    
                                    @foreach((json_decode($monthly->monthly_days)) as $month)
                                    @if($month > date('d-m-Y'))
                                    <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{ day1Format($month) }}<br>{{$month}}</td>
                                      <td>@if($monthly->monthly_sim != null)
                                            <p class="mb-2"><span class="text-primary">South Indian Meal -</span>  {{$monthly->monthly_sim}}</p>
                                       @endif
                                       @if($monthly->monthly_curd != null)
                                            <p class="mb-2"><span class="text-primary">Curd -</span>  {{$monthly->monthly_curd}}</p>
                                       @endif
                                     </td>
                                     <td>
                                     <form method="post" action="{{ route('user.removemonthlyday', ['id' => $monthly->id]) }}">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="date" value="{{ $month }}">
                                        <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                    </form>
                                      </td>
                                      
                                    </tr>
                                    @endif
                                    @endforeach
                                    @empty
                                    <tr>
                                        
                                        <td colspan="5"> No Data Found</td>
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
    </div>
</main>
@endsection