 @extends('layout.user_layout')
 @section('content')
     
     <div class="col-md-10 col-sm-10 clearfix p-5">
         <div class="row m-1 float-right">
             {{-- back to calendar --}}
             <a href="/user/slot" class="btn btn-light text-dark border-dark t">カレンダーへ戻る</a>
         </div>
         <div class="clearfix"></div>
         <div class ="d-flex justify-content-between mt-5 ">
        @if($not_current)    
        <a href="/user/slot/{{$previous_date}}" class="text-dark pr-1"><i class="fas fa-3x fa-caret-left text-secondary"></i></a>
        @else
        <span class="text-dark pr-1"><i class="fas fa-3x fa-caret-left text-secondary"></i></span>
        @endif
        <span style="font-size: 18px;line-height:2.3">{{$date_jp}}</span>   
        <a href="/user/slot/{{$next_date}}" class="text-dark pr-1"><i class="fas fa-3x fa-caret-right text-secondary"></i></a>
             
    </div>
        
     <div class="row">
         <div class="container col-md-12 col-sm-12 ">
            <div class="col-md-12 col-sm-12 border mb-1 text-center"> 
                <h4 class="text-center text-danger">保有機材 {{-- <br/> 車椅子　リクライニング車椅子　ストレッチャー --}}</h4>   
            <div class="row"> 
                <div class="container col-md-12  d-flex justify-content-center mb-2">  
                    {{-- swap wheelchair and re-wheelchair --}}
                    {{-- wheelchair_status --}} 
                     {{-- <span class="text-secondary mr-5"><i class="fas fa-wheelchair "></i> -- 車いす</span> --}}
                           <span class="text-secondary mr-5"><i class="fab fa-accessible-icon"></i> -- 車いす</span>
                     {{-- rewheelchair_status --}}
                     {{--  <span class="text-dark mr-5"><i class="fab fa-accessible-icon"></i> -- リクライニング車いす</span> --}}
                           <span class="text-dark mr-5"><i class="fas fa-wheelchair "></i> -- リクライニング車いす</span>
                     {{-- stretcher_status --}}
                     {{-- <span class="text-success mr-5"><i class="fas fa-walking"></i> --}}  <span class="text-success mr-5"><i class="fas fa-procedures"></i> -- ストレッチャー</span>
                    <table class="mx-5" style="display: none">
                        <tr>
                            <td><span class="text-primary mr-5"><i class="fas fa-medkit "></i> -- 看護/介護</span></td>
                            <td><span class="text-info mr-5"><i class="fas fa-user-nurse"></i> -- ヘルパー</span></td>
                            <td><span class="text-success mr-5"><i class="fas fa-lungs"></i> -- 酸素</span></td>
                            <td><span class="text-danger mr-5"><i class="fas fa-procedures"></i> -- 人工呼吸器</span></td>
                            <td>{{-- wheelchair_status --}}
                                <span class="text-secondary mr-5"><i class="fas fa-wheelchair "></i> -- 車いす</span></td>
                            <td>{{-- rewheelchair_status --}}
                                <span class="text-dark mr-5"><i class="fab fa-accessible-icon"></i> -- リクライニング車いす</span></td>
                        </tr>
                        <tr>
                            <td>{{-- stretcher_status --}}
                                <span class="text-success mr-5"><i class="fas fa-walking"></i> -- ストレッチャー</span></td>
                            <td>
                                {{-- oximeter_status --}}
                                <span class="text-danger mr-5"><i class="fas fa-heartbeat"></i> -- オキシメーター</span>
                            </td>
                            <td>
                                {{-- sputum_status --}}
                                <span class="text-primary mr-5"><i class="fas fa-lungs-virus"></i> -- 吸痰器</span>
                            </td>
                            <td>
                                {{-- slope_status --}}
                                <span class="text-info mr-5"><i class="fas fa-clinic-medical"></i> -- スロープ</span>
                            </td>
                            <td>
                                {{-- basic_care_status --}}
                                <span class="text-success mr-5"><i class="fab fa-medrt"></i> -- 基本介助</span>
                            </td>
                            <td>
                                {{-- attendant_status --}}
                                <span class="text-danger mr-5"><i class="fas fa-user-plus"></i> -- 付添介助</span>
                            </td>
                        </tr>
                    </table>
                </div>       
            </div>

            </div>
         </div>
     </div>
    <form action="/care-taxi/company/update/"  method="POST" >
        @csrf
        
       {{--  <input type="submit" class="btn btn-primary float-right" value="アップデート" /> --}}
        {{-- <input type="hidden" name="id" value="{{$company->id}}" /></td> --}}
        <table class="table table-hover table-bordered bg-light" >
            <thead class="bg-light">
            <th style="width: 150px;position:sticky" class="bg-light" id="show" >{{-- 時間 --}} ↑全ての時間を表示 <span class="text-primary"> <i class="fas fa-caret-right" ></i></span></th>
            <th style="width: 150px;position:sticky" class="bg-light" id="remove">{{-- 時間 --}} ↑全ての時間を表示 <span class="text-primary"></i> <i class="fas fa-caret-down" ></i> </span></th>
            @foreach ($comp_list as $com)
            <th class="text-center text-break" style="min-width:100px;vertical-align:baseline" ><a class="text-dark" href="/user/company/detail/{{$com->id}}">{{$com->alias}}</a><br>
            {{-- @if($com->nursing_status != "times" )
            <span class="text-primary"><i class="fab fa-accessible-icon "></i></span>
            @endif
            @if($com->helper_status != "times" )
             <span class="text-info"><i class="fas fa-user-nurse"></i></span>
            @endif
             @if($com->oxygen_status != "times" )
             <span class="text-success "><i class="fas fa-lungs"></i></span>
            @endif
            @if($com->ventilator_status != "times" )
             <span class="text-danger "><i class="fas fa-procedures"></i> </span>
            @endif --}}
            @if($com->wheelchair_status != "times" )
             {{-- <span class="text-secondary"><i class="fas fa-wheelchair "></i> </span> --}}
             <span class="text-secondary"><i class="fab fa-accessible-icon"></i> </span>
             
            @endif
             @if($com->re_wheelchair_status != "times" )
             {{--  <span class="text-dark"><i class="fab fa-accessible-icon"></i> </span> --}}
               <span class="text-dark"><i class="fas fa-wheelchair"></i> </span>
            @endif
             @if($com->stretcher_status != "times" )
              {{-- <span class="text-success"><i class="fas fa-walking"></i> </span> --}}
               <span class="text-success "><i class="fas fa-procedures"></i> </span>
            @endif
            @if($com->stretcher_status == "times" && $com->re_wheelchair_status == "times" && $com->wheelchair_status == "times"  )
              {{-- <span class="text-success"><i class="fas fa-walking"></i> </span> --}}
               <span class="text-success " style="visibility: hidden"><i class="fas fa-procedures"></i> </span>
            @endif
            {{--  @if($com->oximeter_status != "times" )
              <span class="text-danger"><i class="fas fa-heartbeat"></i> </span>
            @endif
            @if($com->sputum_status != "times" )
              <span class="text-primary"><i class="fas fa-lungs-virus"></i> </span>
            @endif
            @if($com->slope_status != "times" )
              <span class="text-info"><i class="fas fa-clinic-medical"></i> </span>
            @endif
            @if($com->basic_care_status != "times" )
              <span class="text-success"><i class="fab fa-medrt"></i> </span>
            @endif
            @if($com->attendant_status != "times" )
              <span class="text-danger"><i class="fas fa-user-plus"></i> </span>
            @endif --}}
            </th>      
           @endforeach
            </thead>
        <tbody style="overflow:auto!important">
            @foreach ($time as $key => $t)
            <tr class="{{(idate('H', strtotime($t["time"])) < 8)? 'hide-slot' : ''}}">
                <td style="" class="">{{ date('H:i', strtotime($t["time"]))}}</td>
                 @foreach ($comp_list as $com)
                 @if(isset($t["status_".$com->id]))
                    @if($t["status_".$com->id] == "circle")
                    <td class="text-center"><a href="/user/contact/{{$com->id}}/{{$date}}/{{$t["time"]}}/{{$t["status_".$com->id]}}"> 
                        <div class="text-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                            <circle cx="8" cy="8" r="8"/>
                        </svg>
                    </div>
                        </a>
                    </td>
                    @elseif($t["status_".$com->id] == "triangle")
                    <td class="text-center"><a href="/user/contact/{{$com->id}}/{{$date}}/{{$t["time"]}}/{{$t["status_".$com->id]}}"> 
                        <div class="text-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z"/>
                        </svg>
                    </div>
                        </a>
                    </td>
                    @elseif($t["status_".$com->id] == "times")
                    <td style="background-color: darkgrey"></td>
                    @endif
                    
                 @else
                    <td style="background-color: darkgrey"></td>
                 @endif

                 @endforeach
               
                
            </tr>
            @endforeach
           
           </tbody>
        </table>
    </form>
     </div>
 
 
 @endsection