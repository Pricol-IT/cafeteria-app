@extends('layouts.app')
@section('title')
    {{__('Reports')}}
@endsection
@section('main')
<main id="main" class="main">
    
    <div class="row">
        <div class="col-lg-12">
          <div class="breadcome-list">
            <div class="row p-3">
              <div class="col-lg-6">
                <h4 class="text-white fw-bold">Live Delivery Details</h4>
              </div>
              <div class="col-lg-6 text-lg-end">
                    
                </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-12">
            <div class="card breadcome-bottom">
                <div class="p-4">
                    <table width="100%">
                        <tr>
                            <td></td>
                            <td>Booked</td>
                            <td>Delivered</td>
                            <td>Remaining</td>
                        </tr>
                        <tr>
                            <td><h5 class="text-primary">Special Meals</h5></td>
                            <td><p class="text-primary">{{ $datas ? $datas[0]->total_spm : '0' }}</p></td>
                            <td><p class="text-success">{{$datas ? $datas[0]->delivered_spm : 0}}</p></td>
                            <td><p class="text-danger">{{$datas ? $datas[0]->remaining_spm : 0}}</p></td>
                            
                        </tr>
                        <tr>
                            <td><h5 class="text-primary">South Indian</h5></td>
                            <td><p class="text-primary">{{ $datas ? $datas[0]->total_sim : '0' }}</p></td>
                            <td><p class="text-success">{{$datas ? $datas[0]->delivered_sim : 0}}</p></td>
                            <td><p class="text-danger">{{$datas ? $datas[0]->remaining_sim : 0}}</p></td>

                        </tr>
                        <tr>
                            <td><h5 class="text-primary">Curd</h5></td>
                            <td><p class="text-primary">{{ $datas ? $datas[0]->total_curd : '0' }}</p></td>
                            <td><p class="text-success">{{$datas ? $datas[0]->delivered_curd : 0}}</p></td>
                            <td><p class="text-danger">{{$datas ? $datas[0]->remaining_curd : 0}}</p></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</main>
@endsection