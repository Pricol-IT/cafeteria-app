@extends('layouts.app')
@section('title')
    {{__('Price Master')}}
@endsection
@section('main')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
          <div class="breadcome-list">
            <div class="row p-3">
              <div class="col-lg-6">
                <h4 class="text-white fw-bold">Price Master</h4>
              </div>
              <div class="col-lg-6 text-lg-end"><a href="{{route('price_master.create')}}" class="btn btn-light round">Create</a></div>
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
                                  <th scope="col">Code</th>
                                  <th scope="col">Menu Type</th>
                                  <th scope="col">Qty</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">Validity Start Date</th>
                                  <th scope="col">Validity End Date</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                
                                @forelse ($prices as $price)
                                
                                
                                <tr>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{$price->code}}</td>
                                  <td>{{$price->menu_type}}</td>
                                  <td>{{$price->quantity}}</td>
                                  <td>{{'₹ '.$price->price}}</td>
                                  <td>{{$price->start_date ? convertDateFormat($price->start_date) : '-'}}</td>
                                  <td>{{$price->end_date ? convertDateFormat($price->end_date) : '-'}}</td>
                                 <td>
                                     <a href="{{route('price_master.edit',$price->id)}}">
                                        <i class="bi bi-pencil"></i>
                                    </a> 
                                    <!-- <form action="{{ route('price_master.destroy', $price->id) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('{{ __('Are you sure you want to delete this Price') }}');" class="btn ll-p-0"><i class="bi bi-trash"></i>
                                        </button>
                                    </form> -->
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