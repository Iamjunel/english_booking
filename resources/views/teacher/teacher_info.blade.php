 @extends('layout.teacher_layout')
 @section('content')
{{-- 
Teachers Profile Page

 
 --}}     <div class="col-md-8 col-sm-12 clearfix p-5">
          <div class="float-left">
              <a class="text-dark pr-1"><i class="fas fa-3x fa-caret-left text-secondary"></i></a>
              <h3 class="float-right" style="line-height: 1.8">Teacher's Profile</h3>
          </div>
         <form action="/teacher/update"  method="POST" enctype="multipart/form-data">
        @csrf
        
        <input type="submit" class="btn btn-primary float-right" value="Update" />
        <input type="hidden" name="id" value="{{$teacher->id}}" /></td>
        <table class="table table-striped table-hover table-bordered bg-light">
        <tbody>
            <tr>
                                    <td style="width: 100px">ID</td>
                                    <td><input type="text" name="tid" value="{{$teacher->tid}}"  
                                         oninvalid="this.setCustomValidity('必須項目が入力されていません。')"
                                         oninput="this.setCustomValidity('')"
                                         required
                                         />
                                        </td>
                                </tr>
                                <tr>
                                    <td>{{-- パスワード --}} Password</td>
                                        <td><input type="password" name="tpass" value="{{$teacher->tpass}}" 
                                             oninvalid="this.setCustomValidity('必須項目が入力されていません。')"
                                             oninput="this.setCustomValidity('')"
                                             required
                                             />
                                        </td>
                                </tr>
                                
                                <tr>
                                    <td>{{-- タクシー会社名 --}} Name</td>
                                        <td><input type="text" name="name" value="{{$teacher->name}}"  oninvalid="this.setCustomValidity('必須項目が入力されていません。')"
                                        oninput="this.setCustomValidity('')"
                                        required />
                                            {{-- <input type="hidden" name="name" value="{{$teacher->name}}"/> --}}
                                        </td>

                                </tr>
                                <tr>
                                    <td>{{-- タクシー会社名 --}} Nickname</td>
                                        <td><input type="text" name="nickname" value="{{$teacher->nickname}}"  oninvalid="this.setCustomValidity('必須項目が入力されていません。')"
                                        oninput="this.setCustomValidity('')"
                                        required />
                                            {{-- <input type="hidden" name="name" value="{{$teacher->name}}"/> --}}
                                        </td>

                                </tr>
                                 <tr>
                                    <td>E-mail address</td>
                                        <td><input type="email" name="email" value="{{$teacher->email}}" onChange="halfWidth(this)" /></td>

                                </tr>
                                <tr>
                                    {{-- profile --}}
                                    <td>{{-- プロフィール --}} Profile</td>
                                        <td><textarea name="profile" rows="4" cols="50" >{{$teacher->profile}}</textarea></td>

                                </tr>
                                <tr>
                                        <td className="align-middle">Lesson Time</td>
                                        <td className="p-1 m-0 pb-2" style="width: 400px">
                                            <table>
                                                <tr>
                                                    <td style="width: 100px">{{-- 月曜日 --}} Mon</td>
                                                    <td><input type="time" name="mon_start" value="{{$bh->monday_start}}" /></td> 
                                                    <td><span style="font-size:18px;font-weight:600;font-family: emoji">~</span></td> 
                                                    <td><input type="time" name="mon_end" value="{{$bh->monday_end}}"  /></td>
                                                </tr>
                                                <tr>
                                                    <td>{{-- 火曜日 --}} Tue</td>
                                                    <td><input type="time" name="tue_start" value="{{$bh->tuesday_start}}"  /></td> 
                                                    <td><span style="font-size:18px;font-weight:600;font-family: emoji">~</span></td> 
                                                    <td><input type="time"  name="tue_end" value="{{$bh->tuesday_end}}" /></td>
                                                </tr>
                                                <tr>
                                                    <td>{{-- 水曜日 --}} Wed</td>
                                                    <td><input type="time" name="wed_start" value="{{$bh->wednesday_start}}"  /></td>
                                                    <td><span style="font-size:18px;font-weight:600;font-family: emoji">~</span></td> 
                                                    <td><input type="time" name="wed_end"  value="{{$bh->wednesday_end}}" /></td>
                                                </tr>
                                                <tr>
                                                    <td>{{-- 木曜日 --}} Thu</td>
                                                    <td><input type="time" name="thu_start" value="{{$bh->thursday_start}}"  /></td>
                                                    <td><span style="font-size:18px;font-weight:600;font-family: emoji">~</span></td> 
                                                    <td><input type="time" name="thu_end"  value="{{$bh->thursday_end}}"/></td>
                                                </tr>
                                                <tr>
                                                    <td>{{-- 金曜日 --}} Fri</td>
                                                    <td><input type="time" name="fri_start"  value="{{$bh->friday_start}}" /></td>
                                                    <td><span style="font-size:18px;font-weight:600;font-family: emoji">~</span></td> 
                                                    <td><input type="time" name="fri_end" value="{{$bh->friday_end}}" /></td>
                                                </tr>
                                                <tr>
                                                    <td>{{-- 土曜日 --}} Sat</td>
                                                    <td><input type="time" name="sat_start" value="{{$bh->saturday_start}}" /></td>
                                                    <td><span style="font-size:18px;font-weight:600;font-family: emoji">~</span></td> 
                                                    <td><input type="time" name="sat_end" value="{{$bh->saturday_end}}"   /></td>
                                                </tr>
                                                <tr>
                                                    <td>{{-- 日曜日 --}} Sun</td>
                                                    <td><input type="time" name="sun_start"  value="{{$bh->sunday_start}}" /></td>
                                                    <td><span style="font-size:18px;font-weight:600;font-family: emoji">~</span></td> 
                                                    <td><input type="time" name="sun_end"   value="{{$bh->sunday_end}}" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                    


                                </tr>
                                <tr>
                                    <td>Message to Students</td>
                                        <td><textarea name="message_students" rows="4" cols="50" >{{$teacher->message_students}}</textarea></td>

                                </tr>
                                <tr>
                                    <td>Message to Staff</td>
                                        <td><textarea name="message_admin" rows="4" cols="50" >{{$teacher->message_admin}}</textarea></td>

                                </tr>
                                <tr>
                                        <td className="align-middle">{{-- スタッフより --}} Strong point</td>
                                        <td className="p-1 m-0 pb-2" style="width: 400px">
                                            <table>
                                                <tr>
                                                    <td style="width: 100px">{{-- 初心者向け --}} Beginner</td>
                                                    <td style="width: 300px">                                                        
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input circle" type="radio" name="beginner" id="inlineRadio1" value="circle"
                                                            @if($teacher->beginner == 'circle')
                                                            {{'checked'}} 
                                                            @endif
                                                            >
                                                            <label class="form-check-label" for="inlineRadio1">
                                                                <span class="text-info">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                                <circle cx="8" cy="8" r="8"/>
                                                                </svg>
                                                                </span>
                                                            </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                            <input class="form-check-input triangle" type="radio" name="beginner" id="triangle" value="triangle"
                                                            @if($teacher->beginner == 'triangle')
                                                            {{'checked'}} 
                                                            @endif
                                                            >
                                                            <label class="form-check-label" for="inlineRadio2">
                                                                <span class="text-warning">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z"/>
                                                                </svg>
                                                                </span>
                                                            </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                            <input class="form-check-input times" type="radio" name="beginner" id="inlineRadio3" value="times"
                                                            @if($teacher->beginner == 'times')
                                                            {{'checked'}} 
                                                            @endif
                                                            >
                                                            <label class="form-check-label" for="inlineRadio3">
                                                                <span class="text-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                                </svg>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>{{-- 試験対策 --}} Exam</td>
                                                    <td style="width: 300px">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input circle" type="radio" name="exam" id="inlineRadio1" value="circle"
                                                            @if($teacher->exam == 'circle')
                                                            {{'checked'}} 
                                                            @endif
                                                            >
                                                            <label class="form-check-label" for="inlineRadio1">
                                                                <span class="text-info">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                                <circle cx="8" cy="8" r="8"/>
                                                                </svg>
                                                                </span>
                                                            </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                            <input class="form-check-input triangle" type="radio" name="exam" id="triangle" value="triangle"
                                                            @if($teacher->exam == 'triangle')
                                                            {{'checked'}} 
                                                            @endif
                                                            >
                                                            <label class="form-check-label" for="inlineRadio2">
                                                                <span class="text-warning">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z"/>
                                                                </svg>
                                                                </span>
                                                            </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                            <input class="form-check-input times" type="radio" name="exam" id="inlineRadio3" value="times"
                                                            @if($teacher->exam == 'times')
                                                            {{'checked'}} 
                                                            @endif
                                                            >
                                                            <label class="form-check-label" for="inlineRadio3">
                                                                <span class="text-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                                </svg>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>{{-- 日常会話 --}} Daily Conversation</td>
                                                    <td style="width: 300px">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input circle" type="radio" name="conversation" id="inlineRadio1" value="circle"
                                                            @if($teacher->conversation == 'circle')
                                                            {{'checked'}} 
                                                            @endif
                                                            >
                                                            <label class="form-check-label" for="inlineRadio1">
                                                                <span class="text-info">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                                <circle cx="8" cy="8" r="8"/>
                                                                </svg>
                                                                </span>
                                                            </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                            <input class="form-check-input triangle" type="radio" name="conversation" id="triangle" value="triangle"
                                                            @if($teacher->conversation == 'triangle')
                                                            {{'checked'}} 
                                                            @endif
                                                            >
                                                            <label class="form-check-label" for="inlineRadio2">
                                                                <span class="text-warning">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z"/>
                                                                </svg>
                                                                </span>
                                                            </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                            <input class="form-check-input times" type="radio" name="conversation" id="inlineRadio3" value="times"
                                                            @if($teacher->conversation == 'times')
                                                            {{'checked'}} 
                                                            @endif
                                                            >
                                                            <label class="form-check-label" for="inlineRadio3">
                                                                <span class="text-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                                </svg>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                               
                                            </table>
                                        </td>
                                </tr>
                              
                                {{-- </form> --}}
                                <tr>
                                    <td>Image</td>
                                    <td>

                                        {{-- <form action="{{ route('multiple.image.store') }}" method="POST" enctype="multipart/form-data"> --}}
                                        {{-- @csrf
                                        <input type="hidden" name="id" value="{{$teacher->id}}" /> --}}

                                        
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <input type="file" name="file[]" accept="image/*" multiple="multiple" class="form-control" >
                                              {{--  <button type="button" class="styleClass" onclick="document.getElementById('getFile').click()">Select Image</button>
                                                <input type='file' id="getFile" style="display:none"> --}}
                                               
                                            </div>
                                
                                           {{--  <div class="col-md-3 col-sm-6">
                                                <button type="submit" class="btn btn-success">アップロード</button>
                                            </div> --}}
                                        </div>
                                        
                                    </form>
                                    <div class="row mt-3 p-5">
                                            @if ($teacher_images)
                                                @foreach($teacher_images as $value)
                                                <div class="col-md-3 col-sm-4 p-1 m-2">
                                                    <form action="/teacher/removeImage/{{$value->id}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    <img src="{{ asset('images/'.$value->url) }}" width="100" height="100">
                                                    <button type="submit" class="btn btn-danger btn-sm mt-1"><i class="fas fa-trash-alt">{{-- 消去 --}}</i></button>
                                                    </form>
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
        </table>
    
         <input type="submit" class="btn btn-primary float-right" value="Update" />
     </div>
 
 
 @endsection