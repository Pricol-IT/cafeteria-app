@extends('admin.layouts.app')
@section('title')
    {{__('Create User')}}
@endsection
@section('links')
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
@endsection
@section('main')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
          <div class="breadcome-list">
            <div class="row p-3">
              <div class="col-lg-6">
                <h4 class="text-white fw-bold">Auto Booking</h4>
              </div>
              <div class="col-lg-6 text-lg-end">
                <!-- <a href="{{route('user.create')}}" class="btn btn-light round">Add User</a> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
            <div class="card breadcome-bottom p-4">
                <form method="post" action="{{route('auto_booking.store')}}">
                    @csrf
                    @method('POST')
                    <div class="row">
                        
                        <div class="col-lg-6 offset-lg-3 col-sm-12 col-md-4 pt-2 pb-2">
                            <select data-placeholder="Select Emp ID" multiple class="chosen-select form-control" name="user_id[]" required>
                                @forelse($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->emp_id }} - {{ $user->name }}</option>
                                @empty
                                    <option>No Users Found</option>
                                @endforelse
                            </select>
                            <p id="errorsv"></p>
                            @if ($errors->has('user_id'))
                              <span class="error text-danger">{{ $errors->first('user_id') }}</span>
                          @endif
                        </div>
                        <div class="col-lg-6 offset-lg-3 col-md-4 pt-2 pb-2">
                            <label>Sp Meal</label>
                            <input class="form-check-input border border-primary p-2" type="checkbox" name="monthly_spm" value="1" />
                            @if ($errors->has('rfid'))
                              <span class="error text-danger">{{ $errors->first('rfid') }}</span>
                          @endif
                          <label>Si Meal </label>
                            <input class="form-check-input border border-primary p-2" type="checkbox" name="monthly_sim" value="1" />
                            @if ($errors->has('email'))
                              <span class="error text-danger">{{ $errors->first('email') }}</span>
                          @endif  
                          <label>Curd</label>
                            <input class="form-check-input border border-primary p-2" type="checkbox" name="monthly_curd" value="1" />
                            @if ($errors->has('location'))
                              <span class="error text-danger">{{ $errors->first('location') }}</span>
                          @endif  
                        </div>
                        
                        <div class="col-lg-12 pt-2 pb-2">
                            <center><input type="submit" name="submit" value="Save" class="btn btn-primary">
                            <a href="{{route('auto_booking.index')}}" class="btn btn-danger">Back</a>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </main><!-- End #main -->
@endsection
@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>


<script type="text/javascript">
    
    $("#menusubmit").submit(function (e) {
      e.preventDefault();
    });
  $(".chosen-select").chosen({disable_search_threshold: 10});
    

    $("body").on("change","input[name='monthly_spm']",function(){
    
    var relatedSP = $('input[name="monthly_sim"]');

    if ($(this).is(':checked')) {
        // Disable corresponding SP checkboxes
        relatedSP.prop('disabled', true);
        relatedSP.prop('checked', false);
    } else {
        // Enable corresponding SP checkboxes
        relatedSP.prop('disabled', false);
    }
  
    });


    $("body").on("change","input[name='monthly_sim']",function(){
    
    var relatedSP = $('input[name="monthly_spm"]');

    if ($(this).is(':checked')) {
        // Disable corresponding SP checkboxes
        relatedSP.prop('disabled', true);
        relatedSP.prop('checked', false);
    } else {
        // Enable corresponding SP checkboxes
        relatedSP.prop('disabled', false);
    }
  
    });
</script>
@endsection