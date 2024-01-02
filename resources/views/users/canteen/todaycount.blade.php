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

                                    @if(count($results) > 0)
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td >Total</td>
                                            <td>{{ $totalSpm }}</td>
                                            <td>{{ $totalSim }}</td>
                                            <td>{{ $totalCurd }}</td>
                                        </tr>
                                    @endif
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
@section('script')
<script type="text/javascript" src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<!-- Your existing table code -->

<script type="text/javascript">
    $(document).ready(function() {
        $('.datatable').DataTable({
            "lengthMenu": [10, 20, 50, 100], // Set the available options for items per page
            "pageLength": 10, // Set the default number of items per page
            // Add other DataTables options if needed
        });
    });
</script>

@endsection