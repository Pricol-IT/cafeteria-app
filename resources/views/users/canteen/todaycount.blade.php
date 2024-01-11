@extends('layouts.app')
@section('title')
    {{__('Today Over all Count')}}
@endsection
@section('links')

 <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">
 
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
                            <table class="table datatable1" >
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
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- Your existing table code -->

<script type="text/javascript">
    
$(document).ready(function() {
    $('.datatable1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'print'
        ],
        lengthMenu: [10, 25, 50, 75, 100], // Specify the options for number of entries per page
        pageLength: 50 
    } );
} );
</script>

@endsection