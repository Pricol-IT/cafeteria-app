<script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
<script>


@if(Route::is('user.home'))
jSuites.calendar(document.getElementById('calendar'),{
    format: 'DD/MM/YYYY'
});
@endif


</script>

<script>
        // Disable right-click
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });

        // Disable Ctrl+Shift+I
        document.addEventListener('keydown', function (e) {
            if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.keyCode === 73) {
                e.preventDefault();
            }
            if (e.key === 'F12') {
                e.preventDefault();
            }
        });

        function ReadNotification() {
        $.ajax({
            url: "{{ route('markAsRead') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(data) {
                $('#unNotifications').html('');
            }
        });
    }

    </script>