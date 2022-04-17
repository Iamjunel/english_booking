<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('APP_NAME')}}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.6/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        .fc-past {
    background-color: rgb(231, 230, 230);
}
        .hide{
            display: none;
        }
        

        </style>

    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
     
</head>
{{-- <body style="background-color:#1885f5ad;overflow-y:auto;"> --}}
    <body style="overflow-y:auto;">
    <nav class="container pt-2">
        @if(Session::get('tid'))
            <a class=" text-dark float-right" href="{{url('teacher/logout')}}">ログアウト</a>
        @endif
        {{-- <a href="/care-taxi" class="text-dark" style="text-decoration: none">津ケアタクネット</a> --}}
        <a href="/teacher" class="text-dark" style="text-decoration: none">Think English Learning Center(Teacher)</a>
        
    </nav>
    <hr/>
    <div class="">
        <div class="row justify-content-center pt-2">
            @if(Session::has('message'))
                @if(Session::get('success'))
                <div class="alert alert-success">
                @else
                <div class="alert alert-danger">
                @endif
                {{Session::get('message')}}
                </div>
            @endif
        </div>
        <div class="row justify-content-center">
           @yield('content')
           <input type="hidden" id="enc_id" value="{{Session::get('id')}}"/>
     </div>
    </div> 

 
 
 <script src="{{ asset('js/app.js') }}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.6/fullcalendar.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
 
 <script>
    
    $(document).ready(function() {
        $.fn.datepicker.dates['ja'] = {
        days: [ "日曜日", "月曜日", "火曜日", "水曜日", "木曜日", "金曜日", "土曜日" ],
        daysShort: [ "日", "月", "火", "水", "木", "金", "土" ],
        daysMin: [ "日", "月", "火", "水", "木", "金", "土" ],
        months: [ "1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月" ],
        monthsShort: [ "1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月" ],
        today: "Today",
        clear: "Clear",
        format: "yy/mm/dd",
        titleFormat: "yyyy年 ", /* Leverages same syntax as 'format' */
        yearSuffix: "年",
        };
			$("#bao").datepicker({
				format: "yyyy年mm月",
                viewMode: "months", 
                minViewMode: "months",
				autoclose:true,
                language: "ja"
				
			});
	})


     /* /* $('div.alert').delay(3000).slideUp(300);
    $(document).ready(function(){
         $('#choose-file').inputFileText({
    text: 'Select File' */
    //}); */
    /* $('#field-test2').on('click', function(){
        $( "#field-test" ).append(',' + $( "#field-test2" ).val()); 
    }); */
    //});
    $(document).ready(function(){
    $('.circle').on("click",function() {
    if($(this).is(':checked')) 
        { 
            var name = '#' +$(this).attr('name');
            var root = $(this).parent().parent().parent();
            var target = root.find("td input");
             console.log(name);
        $(target[3]).removeClass("hide");
        }else{

        }
        
    }); 
    $('.line').on("click",function() {
    if($(this).is(':checked')) 
        { 
            var name = '#' +$(this).attr('name');
            var root = $(this).parent().parent().parent();
            var target = root.find("td input");
        $(target[3]).addClass("hide");
        }else{

        }
        
    }); 
    $('.times').on("click",function() {
    if($(this).is(':checked')) 
        { 
            var name = '#' +$(this).attr('name');
            var root = $(this).parent().parent().parent();
            var target = root.find("td input");
        $(target[3]).addClass("hide");
        }else{

        }
        
    }); 
    });

    
    
</script>

   

    <script>
    
        $(document).ready(function () {
            
            var SITEURL = "{{ url('/') }}";
            var enc_id = $("#enc_id").val();
            console.log(enc_id);
            //var id = {{Session::get('dec_id')}};
            
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
                views: {
                    month: { // name of view
                    titleFormat: 'YYYY/MM'
                    // other view-specific options here
                    }
                },
                editable: false,
                
                selectable: true,
                selectHelper: true,
                select: function (date,event_start, event_end, allDay) {
                       /*  var this_day = moment(date, 'DD.MM.YYYY').format('YYYY-MM-DD');
                 window.location.href = '/care-taxi/slot/'+ id +'/' + this_day; */
                  var check =moment(date, 'DD.MM.YYYY').format('YYYY-MM-DD');
                    var today = moment(new Date(), 'DD.MM.YYYY').format('YYYY-MM-DD');
                    if (check >= today) {
                    //var this_day = $.fullCalendar.formatDate(date, "Y-MM-DD");
                       var this_day = moment(date, 'DD.MM.YYYY').format('YYYY-MM-DD')
                 window.location.href = '/teacher/slot/'+ enc_id +'/' + this_day;
                    }
                    /* var event_name = prompt('Event Name:');
                    if (event_name) {
                        var event_start = $.fullCalendar.formatDate(event_start, "Y-MM-DD HH:mm:ss");
                        var event_end = $.fullCalendar.formatDate(event_end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: SITEURL + "/calendar-crud-ajax",
                            data: {
                                event_name: event_name,
                                event_start: event_start,
                                event_end: event_end,
                                type: 'create'
                            },
                            type: "POST",
                            success: function (data) {
                                displayMessage("Event created.");

                                calendar.fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: event_name,
                                    start: event_start,
                                    end: event_end,
                                    allDay: allDay
                                }, true);
                                calendar.fullCalendar('unselect');
                            }
                        });
                    } */
                },
                /* dayClick: function(date, jsEvent, view) {

        alert('Clicked on: ' + date.format());

        alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

        alert('Current view: ' + view.name);

        // change the day's background color just for fun
        $(this).css('background-color', 'red');

        }, */
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
               /*  eventClick: function (event) {
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
       $("#datepicker").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
});

        function displayMessage(message) {
            toastr.success(message, 'Event');            
        }

       
   function halfWidth(obj) {
   var str = obj.value; 
   var result =""; 
   str = str.replace(/[\u3040-\u309F]+/g, "");
   if(str.length == 0){
     obj.value = "";
   }
   else
   {
       for (var i = 0; i <str.length; i ++){
     
        if (str.charCodeAt (i) == 12288){
        result += String.fromCharCode(str.charCodeAt (i) -12256); 
        continue;
        } 
        
        if (str.charCodeAt (i)> 65280 && str.charCodeAt (i) <65375){ 
        result += String.fromCharCode (str.charCodeAt (i) -65248);
        }
        else 
        {
          result += String.fromCharCode (str.charCodeAt (i));
        } 
    obj.value = result; 
    }
   }
   
   console.log(str.length);

   
  }
  function checkDate(obj) {
   var str = obj.value; 
   var result =""; 
   //str = str.replace(/[\u3040-\u309F]+/g, "");
   /* if(str.length == 0){
     obj.value = "";
   }
   else
   {
       for (var i = 0; i <str.length; i ++){
     
        if (str.charCodeAt (i) == 12288){
        result += String.fromCharCode(str.charCodeAt (i) -12256); 
        continue;
        } 
        
        if (str.charCodeAt (i)> 65280 && str.charCodeAt (i) <65375){ 
        result += String.fromCharCode (str.charCodeAt (i) -65248);
        }
        else 
        {
          result += String.fromCharCode (str.charCodeAt (i));
        } 
    obj.value = result; 
    }
   } */
   var year =str.split("-");
   obj.value = year[0]; 
   console.log(year[0]);

   
  }

  $('.input-group.date').datepicker({
       todayBtn: "linked",
       language: "it",
       autoclose: true,
       todayHighlight: true,
       dateFormat: 'dd/mm/yyyy' 
   });

    </script>


</body>
</html>
   