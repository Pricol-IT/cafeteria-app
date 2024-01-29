    @extends('layouts.app')
@section('title')
    {{__('Menu Selection')}}
@endsection
@section('links')
<style type="text/css">
    #calendar {
    width: 90%;
/*    height: 20%;*/
    margin: 0 auto;
  }
  /*.fc .fc-daygrid-body-unbalanced .fc-daygrid-day-events
  {
    display: flex;

  }*/
  .fc .fc-daygrid-body-unbalanced .fc-daygrid-day-events
  {
    min-height: 0px!important;
  }
  .fc-daygrid-event-dot {
    
    border-width:10px;

  }
  .fc .fc-scrollgrid-liquid
   {
/*    min-height: 300px;*/
    max-height: 90%;
   }
  #calendar
   {
    height: 400px!important;
   }
</style>
@endsection
@section('main')
<main id="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div id="date" style="display:none;">{{date('Y-m-d')}}</div>
                <div class="card p-2 ">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6"> <h3 class="fw-bold text-primary">Selected Menu Display</h3></div>
            <div class="col-lg-6 text-lg-end"><a href="{{route('menu_selection.create')}}" class="btn btn-primary round">Select Menu</a></div>
        </div>
        <div class="row">
            @forelse($masters as $master)
            <div class="col-lg-12 mb-2 ">
                <div class="d-flex align-items-center cres flex-wrap justify-content-between m-1 bg-white shadow p-1 ">
                    
                    <div class="image  m-2"><img src="{{$master->menu->imageurl}}" width="80px"></div>
                    <div class="date ">
                        <h5 class="text-primary fw-bold">{{dayFormat($master->day)}}</h5>
                        <p>{{convertWDateFormat($master->day)}}</p>
                    </div>
                    <div>
                        <h5 class="text-primary  fw-bold">{{$master->menu->name}}</h5>
                    </div>
                    <div style="width: 40%;">
                        <p >{{$master->menu->description}}</p>
                    </div>
                    <div class="content p-3">
                        <span>
                            <a href="{{route('menu_selection.edit',$master->id)}}">
                                <i class="bi bi-pencil"></i>
                            </a> 
                            <form action="{{ route('menu_selection.destroy', $master->id) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('{{ __('Are you sure you want to delete this Menu') }}');" class="btn ll-p-0"><i class="bi bi-trash"></i>
                                </button>
                            </form></span>
                        </h5>
                    </div>
                    
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
  </main><!-- End #main -->
@endsection

@section('script')
<script src="{{asset('fullcalendar/dist/index.global.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var calendarId = document.getElementById('calendar');
        var date = document.getElementById('date').innerHTML;
        
        var calendar = new FullCalendar.Calendar(calendarId,{

  // document.addEventListener('DOMContentLoaded', function() {
  //   var calendarEl = document.getElementById('calendar');

  //   var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        // left: 'prev,next',
        // center: 'title',
        right: 'dayGridMonth'
      },
       // aspectRatio: 1,
      initialDate: date,
      initialView: 'dayGridMonth',
        
      navLinks: false, // can click day/week names to navigate views
      businessHours: false, // display business hours
      editable: false,
      selectable: false,

      events: [
        
        
        @foreach($masters as $master)
        {
          start: '{{$master->day}}',
          display: 'background',
          color: '#25ff01'
        },

        @endforeach
        
        
        // {
        //   title: 'Business Lunch',
        //   start: '2023-01-03T13:00:00',
        //   constraint: 'businessHours'
        // },
        

        // areas where "Meeting" must be dropped
        // {
        //   groupId: 'availableForMeeting',
        //   start: '2023-01-11T10:00:00',
        //   end: '2023-01-11T16:00:00',
        //   display: 'background'
        // },
        // {
        //   groupId: 'availableForMeeting',
        //   start: '2023-01-13T10:00:00',
        //   end: '2023-01-13T16:00:00',
        //   display: 'background'
        // },

        // red areas where no events can be dropped
        // {
        //   start: '2023-01-24',
        //   end: '2023-01-28',
        //   overlap: false,
        //   display: 'background',
        //   color: '#ff9f89'
        // },
        
      ],
      displayEventTime : false
    });

    calendar.render();
  });

</script>
@endsection