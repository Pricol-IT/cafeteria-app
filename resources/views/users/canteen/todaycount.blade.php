@extends('layouts.app')
@section('title')
    {{__('Today Over all Count')}}
@endsection
@section('main')
<main id="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-2">
                    <div class="row">
                        <div class="col-lg-12"> <h3 class="fw-bold  text-primary">{{date('d-m-Y')}} - Todays Count </h3></div>
                        <div class="col-lg-6 text-lg-end"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table datatable">
                                  <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Emp ID</th>
                                      <th scope="col">SPM</th>
                                      <th scope="col">SIM</th>
                                      <th scope="col">CURD</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    @forelse ($results as $result)
                                    
                                    <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{ $result->emp_id }}</td>
                                      <td>{{ $result->total_spm }}</td>
                                      <td>{{ $result->total_sim }}</td>
                                      <td>{{ $result->total_curd }}</td>
                                    </tr>
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