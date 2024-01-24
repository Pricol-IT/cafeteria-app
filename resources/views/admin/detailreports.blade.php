@extends('admin.layouts.app')
@section('title')
    {{__(' Day Reports')}}
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
                <h4 class="text-white fw-bold">Day Reports</h4>
              </div>
              <div class="col-lg-6 text-lg-end">
                @if (request('from_date') || request('to_date') || request('emp_id'))
                    <a href="{{ route('admin.detailreports') }}" class="btn btn-danger"><i
                            class="fas fa-times"></i>&nbsp; {{ __('Reset') }}
                    </a>
                @endif
                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">

            <div class="card breadcome-bottom p-3">
                <form action="{{route('admin.detailreports')}}" method="get" onchange="this.submit();">
                @csrf
                @method('GET')  
                <div class="row">
                    <div class="col-lg-4">
                        <label>Emp ID</label>
                        <input list="usercode" name="emp_id" class="form-control" value="{{ request('emp_id') }}" autocomplete="off" placeholder="Select Emp ID">
                        <datalist id="usercode">
                            <option >All</option>
                            @forelse($users as $user)
                            <option>{{$user->emp_id}}</option>
                            @empty
                            @endforelse
                        </datalist>
                    </div>
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
                        <br>
                        <div class="table-responsive">
                            <table class="table datatable1">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Date</th>
                                  <th scope="col">Emp ID</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">SP Meal</th>
                                  <th scope="col">SI Meal</th>
                                  <th scope="col" >CURD</th>
                                  <th scope="col" >Status</th>
                                </tr>
                                
                              </thead>
                              <tbody>
                                
                                

                                @forelse ($records as $record)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ convertDateFormat($record['day']) }}</td>
                                        <td>{{ $record->emp_id }}</td>
                                        <td>{{ $record->name }}</td>
                                        <td>{{ $record->spm }}</td>
                                        <td>{{ $record->sim }}</td>
                                        <td>{{ $record->curd }}</td>
                                        <td>
                                            @if($record->status == 0)
                                            <p class="text-danger">Not Delivered</p>
                                            @else
                                            <p class="text-success">Delivered</p>
                                            @endif
                                        </td>
                                    </tr>

                                    

                                @empty
                                    <tr> 
                                        <td > No Data Found</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        
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