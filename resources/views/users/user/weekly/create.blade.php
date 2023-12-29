@extends('layouts.app')
@section('title')
    {{__('Weekly Create')}}
@endsection
@section('main')
<main id="main" class="main">
  <div class="row">
    <div class="col-6"><h3 class="text-primary fw-bold">Weekly Menu</h3></div>
    <div class="col-6 text-end">
      <a href="{{route('user.weeklyindex')}}" class="btn btn-danger text-end">Cancel Order</a>
    </div>
  </div>
  <form action="{{route('user.weeklystore')}}" method="post">
    @csrf
    @method('post')
      <div class="row">
        @php 



        $days =[];
        $exist = [];
        if($check_day)
        {
        foreach($check_day as $day)
        {
          $days[] = $day->day;
          $days[$day->day]['spm'] = $day->spm;
        }
      }

        foreach($existArray as $exists)
        {
          $exist[] = date('Y-m-d',strtotime($exists));

        }
         @endphp
          
         

        @forelse($masters as $master)
        
        
        <div class="col-lg-4 d-flex">
          <div class="card bg-primary p-3 flex-fill rounded shadow {{ in_array($master->day, $days) ? 'bg-light' : 'bg-primary' }} {{ in_array($master->day, $exist) ? 'bg-light' : 'bg-primary' }}">
            <div class="daycontent flex-fill bg-white ms-2 p-2 rounded ">
              <img class="float-left" src="{{ $master->menu->imageurl }}" class="p-2" width="120px" style="position: relative; left: -20px; top: -10px;float: left;border-radius: 50%;"/>
              <div class="menucontent  ms-2" style="position: relative; left: -11px">
                <h6 class="text-primary fw-bold">{{dayFormat($master->day)}} Menu</h6>
                <h6>
                  {{convertDateFormat($master->day)}}
                  

                </h6>

                <p style="font-size: 12px" class="mt-1">
                  {{$master->menu->description}}
                </p>
              </div>
              <input type="checkbox" name="sp[]" {{ in_array($master->day, $exist) ? 'disabled' : '' }} {{ in_array($master->day, $days) ? 'disabled' : '' }} data-date="{{$master->day}}" class="offset-8  border border-primary form-check-input" value="{{$master->day}}"  >
            </div>
            <!-- <button type="button" class="btn btn-outline-light offset-8 mt-2">
              Add <i class="bi bi-plus-lg"></i>
            </button> -->
            
          </div>
        </div>
        @empty
        @endforelse
      </div>
      <div class="row mt-2 mb-2">
        <div class="col-lg-6 mb-2 southindianitem">
          <table style="margin-left: auto">
            <tr class="text-primary">
              <th class="p-1"></th>
              @forelse($masters as $master)
              <th class="p-1">{{Shortname($master->day)}} <br> <p style="font-size:10px;">{{convertDateFormat($master->day)}}</p> <input type="hidden" {{ in_array($master->day, $days) ? 'disabled' : '' }}  name="day[]" value="{{$master->day}}"></th>
              @empty
              @endforelse
            </tr>
            <tr class="text-primary">
              <td class="p-1 fw-bold">South Indian Meal</td>
              @forelse($masters as $master)

              <td class="p-2">
                
                <input class="form-check-input p-2 border {{ in_array($master->day, $exist) ? 'border-link ' : 'border-primary' }} " {{ in_array($master->day, $days) ? 'disabled' : '' }} {{ in_array($master->day, $exist) ? 'disabled ' : '' }} data-date="{{$master->day}}" type="checkbox" name="si[]" id=""   value="{{$master->day}}" />
                
              </td>
              
              @empty
              @endforelse
            </tr>
            <tr class="text-primary">
              <td class="p-2 fw-bold">Curd</td>
              @forelse($masters as $master)
              <td class="p-2">
                
                <input class="form-check-input p-2 border  {{ in_array($master->day, $exist) ? 'border-link ' : 'border-primary' }}  " {{ in_array($master->day, $days) ? 'disabled' : '' }} {{ in_array($master->day, $exist) ? 'disabled ' : '' }}
 type="checkbox" name="curd[]"  id="" value="{{$master->day}}" />
                
              </td>
              
              @empty
              @endforelse
              
            </tr>
          </table>
        </div>
        <div class="col-lg-6">
          <div class="row bg-white p-3 rounded">
            <div class="col-lg-12">
              <h5 class="fw-bold text-primary">No. of. tokens (selected)</h5>
              <p class=" text-primary">Note: You can only select Either Special Meals or South Indian Meal</p>
              <div class="row">
                <div class="col-6"><p>Special Lunch </p></div>
                <div class="col-6"><p>x <span class="sp badge fw-bold bg-primary">0</span></p></div>
              </div>
              <div class="row">
                <div class="col-6"><p>South Indian Meal</p></div>
                <div class="col-6"><p>x <span class="sim badge fw-bold bg-primary">0</span></p></div>
              </div>
              
              <div class="row">
                <div class="col-6"><p>Curd</p></div>
                <div class="col-6"><p>x <span class="curd badge fw-bold bg-primary">0</span></p></div>
              </div>
              
              
            </div>
            <div class="col-lg-12">
              <center>
                <button onclick="confirm('Are you sure? You want to add this ');" class="btn btn-primary" >confirm</button>
                <a href="{{route('user.weekly')}}" class="btn btn-danger">Cancel</a>
                
              </center>
              
            </div>
          </div>
        </div>
        
      </div>
      </form>
    </main>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript">
  $("body").on("change","input[name='si[]']",function(){

     var date = $(this).data('date');
    var relatedSP = $('input[name="sp[]"][data-date="' + date + '"]');

    if ($(this).is(':checked')) {
        // Disable corresponding SP checkboxes
        relatedSP.prop('disabled', true);
    } else {
        // Enable corresponding SP checkboxes
        relatedSP.prop('disabled', false);
    }
  var sim = $('input[name="si[]"]:checked:not(:disabled').length;
  $('.sim').html(sim);
    });
  $("body").on("change","input[name='curd[]']",function(){
  var curd = $('input[name="curd[]"]:checked:not(:disabled').length;
  $('.curd').html(curd);
    });
  $("body").on("change","input[name='sp[]']",function(){
    var date = $(this).data('date');
    var relatedSP = $('input[name="si[]"][data-date="' + date + '"]');

    if ($(this).is(':checked')) {
        // Disable corresponding SP checkboxes
        relatedSP.prop('disabled', true);
    } else {
        // Enable corresponding SP checkboxes
        relatedSP.prop('disabled', false);
    }
  var sp = $('input[name="sp[]"]:checked:not(:disabled').length;
  $('.sp').html(sp);
    });
</script>
@endsection
