 @extends('layout.taxi_layout')
 @section('content')
 
     <div class="col-md-8 col-sm-12 clearfix mt-1 mb-5">
          <a href="/care-taxi/booking" class="pr-1 text-dark float-right">カレンダーに戻る</a>
         {{-- <h3 class=""><a href="/care-taxi/booking" class="text-dark pr-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
  <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
</svg></a></h3> --}}
    <div class ="d-flex justify-content-between mt-5">
    @if($not_current)    
    <a href="/care-taxi/slot/{{$id}}/{{$previous_date}}" class="text-dark pr-1"><i class="fas fa-3x fa-caret-left text-secondary"></i></a>
    @else
     <span class="text-dark pr-1"><i class="fas fa-3x fa-caret-left text-secondary"></i></span>
    @endif
    <span style="font-size: 20px;line-height:2.1">{{$date_jp}}</span>
    <a href="/care-taxi/slot/{{$id}}/{{$next_date}}" class="text-dark pr-1"><i class="fas fa-3x fa-caret-right text-secondary"></i></a>
    
    </div>
    @if(count($time)>1)
    <a href="/care-taxi/slot/edit/{{$id}}/{{$date}}" class="btn btn-primary btn-block clearfix mb-1">編集</a>
    <form action="/care-taxi/company/update/"  method="POST" >
        @csrf
        
       {{--  <input type="submit" class="btn btn-primary float-right" value="アップデート" /> --}}
        <input type="hidden" name="id" value="{{$company->id}}" /></td>
        <table class="table table-hover table-bordered bg-light" style="margin-bottom: 0px !important">
            <th>Time</th>
            <th>Booking Status </th>
            <th>Comment</th>
        <tbody>
            @foreach ($time as $key => $t)
            @if($this_time_str > strtotime($t["time"]) && $date == date('Y-m-d'))
            <?php $t["status"] ="times"; ?>
            @endif
            <tr>
                <td  style="width: 100px">{{ date('H:i', strtotime($t["time"]))}}</td>
                @if($t["status"] =="circle")
                <td class="text-center" style="width: 100px" >
                <span class="text-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                    <circle cx="8" cy="8" r="8"/>
                </svg>
                </span>
                </td>
                @elseif($t["status"] =="triangle")
                <td class="text-center" style="width: 100px" >
                <span class="text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z"/>
                            </svg>
                            </span>
                </td>
                @elseif($t["status"] =="times")
                <td class="text-center" style="width: 100px" >
                 <span class="text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                            </span>
                </td>
                @else
                   <td style="background-color: darkgrey;"></td>
                
                @endif
                @if($t["comment"]!="" && $t["status"] =="triangle")
                 <td>{{$t["comment"]}}</td>
                @else
                <td style="
    background-color: darkgrey;
    "></td>
                @endif
            </tr>
            @endforeach
           
           </tbody>
        </table>
    </form>
     <a href="/care-taxi/slot/edit/{{$id}}/{{$date}}" class="btn btn-primary btn-block clearfix mt-1">編集</a>
     @else 
     <a href="/care-taxi/slot/edit/{{$id}}/{{$date}}" class="btn btn-secondary btn-block clearfix mb-1 disabled">編集</a>
     <table class="table table-hover table-bordered bg-light" style="margin-bottom: 0px !important">
            <th>時間</th>
            <th>空き状況</th>
            <th>コメント</th>
        <tbody>           
           </tbody>
        </table>
         <a href="/care-taxi/slot/edit/{{$id}}/{{$date}}" class="btn btn-secondary btn-block clearfix mb-1 disabled">編集</a>
     @endif
     
     </div>

 
 
 @endsection