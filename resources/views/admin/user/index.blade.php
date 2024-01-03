@extends('admin.layouts.app')
@section('title')
    {{__('User Details')}}
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
                            <table class="table datatable">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">ID</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                @forelse ($users as $user)
                                
                                
                                <tr>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{$user->emp_id}}</td>
                                  <td>{{$user->name}}</td>
                                  <td>{{$user->email}}</td>
                                  <td>{{$user->status}}</td>
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