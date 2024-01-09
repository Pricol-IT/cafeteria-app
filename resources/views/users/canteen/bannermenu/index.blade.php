@extends('layouts.app')
@section('title')
    {{__('Banner Menu')}}
@endsection
@section('main')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
          <div class="breadcome-list">
            <div class="row p-3">
              <div class="col-lg-6">
                <h4 class="text-white fw-bold">Banner Menu</h4>
              </div>
              <div class="col-lg-6 text-lg-end"><a href="{{route('banner_menu.create')}}" class="btn btn-light round">Create</a></div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
            <div class="card  breadcome-bottom p-2">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="table-responsive">
                            <table class="table datatable">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Day</th>
                                  <th scope="col">Date</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                
                                @forelse ($banners as $banner)
                                
                                
                                <tr>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{$banner->day_type}}</td>
                                  <td>{{convertWDateFormat($banner->day)}}</td>

                                 <td>
                                     <a href="{{route('banner_menu.edit',$banner->id)}}">
                                        <i class="bi bi-pencil"></i>
                                    </a> 
                                    <!-- <form action="{{ route('banner_menu.destroy', $banner->id) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('{{ __('Are you sure you want to delete this Menu') }}');" class="btn ll-p-0"><i class="bi bi-trash"></i>
                                        </button>
                                    </form> -->
                                  </td>
                                  
                                </tr>
                                
                                
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
</main>
@endsection