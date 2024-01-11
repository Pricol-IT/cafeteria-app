@extends('admin.layouts.app')
@section('title')
    {{__('User Details')}}
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
                <h4 class="text-white fw-bold">User Details</h4>
              </div>
              <div class="col-lg-6 text-lg-end"><a href="{{route('user.create')}}" class="btn btn-light round">Add User</a></div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
            <div class="card breadcome-bottom p-2">
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table datatable1">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Plant</th>
                                  <th scope="col">ID</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">RFID</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                @forelse ($users as $user)
                                
                                
                                <tr>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{$user->company_name}}</td>
                                  <td>{{$user->emp_id}}</td>
                                  <td>{{$user->name}}</td>
                                  <td>{{$user->email}}</td>
                                  <td>{{$user->rfid}}</td>
                                 <td>
                                    <div class="d-flex justify-content-around">
                                        <a href="{{route('user.show',$user->id)}}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </a> 
                                        <a href="{{route('user.edit',$user->id)}}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        
                                         <form method="post" action="{{ route('user.destroy',$user->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                    
                                  </td>
                                  
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
    var currentDate = new Date();
    var formattedDate = currentDate.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });

    // Set the table title with the current date
    var tableTitle = 'User Details - ' + formattedDate;
    $('.datatable1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csv',
                text: 'CSV',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5] // Specify the columns you want to export
                }
            },
            {
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5] // Specify the columns you want to export
                }
                
            }
            
        ],
        lengthMenu: [10, 25, 50, 75, 100], // Specify the options for number of entries per page
        pageLength: 25 ,
        title: tableTitle
    } );
} );
</script>

@endsection