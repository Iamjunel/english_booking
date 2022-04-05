<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('APP_NAME')}}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.6/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .fc-past {
    background-color: rgb(231, 230, 230);
    }
    
.bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }


    .nav-masthead .nav-link {
  padding: .25rem 0;
  font-weight: 700;
  color: rgba(5,57,101,0.5);
  background-color: transparent;
  border-bottom: .25rem solid transparent;
}

.nav-masthead .nav-link:hover,
.nav-masthead .nav-link:focus {
  border-bottom-color: rgba(5,57,101,0.5);
}

.nav-masthead .nav-link + .nav-link {
  margin-left: 1rem;
}


.marker_hoso {
  background: linear-gradient(transparent 60%, #ffc107 60%);
}

.hide-slot{
        display: none;
    }
#remove{
    cursor: pointer;
    display:none;
}
#show{
    cursor: pointer;
}

        </style>
         
</head>
<body style="background-color: #f8fafc !important">
    <nav class="container pt-2">
        @if(Session::get('cid'))
            <a class=" text-dark float-right" href="{{url('user/logout')}}">ログアウト</a>
        @endif
        <a href="/user" class="text-dark" style="text-decoration: none">津ケアタクネット</a>
    </nav>
    <hr/>
    <div class="">
        <div class="row justify-content-center pt-2">
            @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
            @endif
        </div>
        <div class="row justify-content-center">
            
           

           @yield('content')
     </div>
    </div> 

 
 <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.6/fullcalendar.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

 <script>
     $('div.alert').delay(3000).slideUp(300);
     $(document).ready(function () {
            $('#show').click(function(){
                    $('.hide-slot').slideDown().delay(300).show('slow');
                    $('#show').hide();
                    $('#remove').show();
                });
            $('#remove').click(function(){
                $('.hide-slot').slideUp().delay(300).hide('slow');
                 $('#remove').hide();
                 $('#show').show();
            });
        });
     </script>

      <script>
        $(document).ready(function () {

            var SITEURL = "{{ url('/') }}";
            //var id = {{Session::get('id')}};
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#full_calendar_events').fullCalendar({
                header: {
                    // title, prev, next, prevYear, nextYear, today
                    left: 'prev',
                    center: 'title ',
                    right: 'next'
                },
                monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                // 月略称
                monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                // 曜日名称
                dayNames: ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
                // 曜日略称
                dayNamesShort: ['日', '月', '火', '水', '木', '金', '土'],
                editable: false,
                locale: 'es',
                editable: false,
                selectable: true,
                selectHelper: true,
                select: function (date,event_start, event_end, allDay) {
                    /*    // var this_day = $.fullCalendar.formatDate(date, "Y-MM-DD");
                       var this_day = moment(date, 'DD.MM.YYYY').format('YYYY-MM-DD')
                 window.location.href = '/user/slot/' + this_day; */
                    var check =moment(date, 'DD.MM.YYYY').format('YYYY-MM-DD');
                    var today = moment(new Date(), 'DD.MM.YYYY').format('YYYY-MM-DD');
                    if (check >= today) {
                    //var this_day = $.fullCalendar.formatDate(date, "Y-MM-DD");
                       var this_day = moment(date, 'DD.MM.YYYY').format('YYYY-MM-DD')
                 window.location.href = '/user/slot/' + this_day;
                    }
                },
                views: {
                    month: { // name of view
                    titleFormat: 'YYYY/MM'
                    // other view-specific options here
                    }
                }

        
                /* eventDrop: function (event, delta) {
                    var event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                    $.ajax({
                        url: SITEURL + '/calendar-crud-ajax',
                        data: {
                            title: event.event_name,
                            start: event_start,
                            end: event_end,
                            id: event.id,
                            type: 'edit'
                        },
                        type: "POST",
                        success: function (response) {
                            displayMessage("Event updated");
                        }
                    });
                }, */
                /* eventClick: function (event) {
                    var eventDelete = confirm("Are you sure?");
                    if (eventDelete) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/calendar-crud-ajax',
                            data: {
                                id: event.id,
                                type: 'delete'
                            },
                            success: function (response) {
                                calendar.fullCalendar('removeEvents', event.id);
                                displayMessage("Event removed");
                            }
                        });
                    }
                } */
            });
        });
        
        function displayMessage(message) {
            toastr.success(message, 'Event');            
        }
        function callANumber(number){
            window.location=number;
        }

    </script>
</body>
</html>
   