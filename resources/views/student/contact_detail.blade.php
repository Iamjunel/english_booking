 @extends('layout.student_layout')
 @section('content')
 <div class="container">
     <div class="col-md-12 col-sm-12 clearfix">
       
        <div class="row ">
            <div class="container col-md-12 col-sm-12 clearfix border p-5">
                
                <div class="p-2">
                <h3 class="text-center mx-2">{{$company->name}}</h3>
                <div class="row justify-content-center">
                   {{-- <button class="btn btn-primary my-2" onclick="callANumber('tel:{{$company->phone}}')">予約をする</button> --}}
                    @if($is_booked)
                    @if($is_above2hrs)
                    <button class="btn btn-warning" data-toggle="modal" data-target="#sample-{{$company->id}}">レッスンをキャンセルする</button>                      
                    @else
                    <button class="btn btn-secondary" disabled data-toggle="modal" data-target="#sample-{{$company->id}}">レッスンをキャンセルする</button>               
                    @endif
                    <div class="modal fade" id="sample-{{$company->id}}" tabindex="-1" role="dialog" aria- 
                    labelledby="demoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                           
                            <div class="modal-content">                                
                                <div class="modal-body  text-center">
                                        <h4>レッスン予約</h4>
                                        <p>{{ date('H:i', strtotime($time))}} ~ {{ date('H:i', strtotime($time) + 1500 )}}</p>
                                         <p>Teacher Name : {{$company->name}}</p>
                                         <p>このレッスンをキャンセ</p>
                                         <p>ルしてもよろしいですか？</p>

                                </div>
                                <div class="modal-footer">
                                     <form action="/student/booked" method="post">
                                    @csrf
                                    <input type="hidden" name="tid" value="{{$teacher->id}}" />
                                    <input type="hidden" name="date" value="{{$date}}" />
                                    <input type="hidden" name="time" value="{{$time}}" />
                                     <input type="hidden" name="action" value="delete" />
                                    <input type="submit" class="btn btn-primary" value="はい" onclick="this.form.submit(); this.disabled = true;" />

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                   @else
                   
                   <button class="btn btn-primary" data-toggle="modal" data-target="#sample-{{$company->id}}">予約をする</button>
                    
                   <div class="modal fade" id="sample-{{$company->id}}" tabindex="-1" role="dialog" aria- 
                    labelledby="demoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                           
                            <div class="modal-content">                                
                                <div class="modal-body  text-center">
                                        <h4>レッスン予約</h4>
                                        <p>{{$date_jpm}} {{ date('H:i', strtotime($time))}} ~ {{ date('H:i', strtotime($time) + 1500 )}}</p>
                                         <p>Teacher Name : {{$company->name}}</p>
                                         <p>レッスン予約を行います</p>
                                          <p>よろしいですか？</p>

                                </div>
                                <div class="modal-footer">
                                     <form action="/student/booked" method="post">
                                    @csrf
                                    <input type="hidden" name="tid" value="{{$teacher->id}}" />
                                    <input type="hidden" name="date" value="{{$date}}" />
                                    <input type="hidden" name="time" value="{{$time}}" />
                                    <input type="submit" class="btn btn-primary" value="はい" onclick="this.form.submit(); this.disabled = true;"/>

                                    <button type="button" class="btn btn-secondary " data-dismiss="modal">キャンセル</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
                 <p class="text-dark text-center fw-bold">{{$company->phone}}</p>   
                </div>
                <hr/>
                <div class="p-2" style="text-align:center">
                <h3 class="text-center mx-2">{{$date_jp}}</h3>
                <p class="text-dark text-center h2 mt-0 ">
                    <span class="">{{ date('H:i', strtotime($time))}} ~ {{ date('H:i', strtotime($time) + 1500 )}}
                    </span>
                <span class="ml-1">
                    空き状況 :
                    @if($status == "circle")
                   
                        <span class="text-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                            <circle cx="8" cy="8" r="8"/>
                        </svg>
                        </span>
                        </a>
                   
                    @elseif($status == "triangle")
                    
                        <span class="text-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z"/>
                        </svg>
                        </span>
                        </a>
                    
                    @elseif($status == "times")
                    
                         <span class="text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                            </span>
                            </a>
                    
                    @endif
                </span>
                </p>   
                </div>
                @if(isset($company_status->status) && $company_status->status == "triangle")
                <div class="border p-4 my-2 ">
                    <p class="ml-3">コメント</p>
                    <div class=" ml-5 mr-5 p-5" style="background-color: #b8b7b7;border-radius:5px">
                        {{$company_status->comment}}
                    </div>
                </div>
                @endif
                <div class="bg-danger p-3 my-2 text-center text-white">
                    <p>予約確定後のキャンセルは2時間前まで可能です。</li>
                    <p>以降のキャンセルは、レッスン1回とカウントされますのでご注意ください。</li>
                </div>
                {{-- <div class="border" style="text-align:left">
                    <p class="ml-2"> 予約の注意事項</p>
                       
                         
                    
                </div> --}}
                <div class="row justify-content-center">
                    <a href="/student/slot/{{$date}}" class="btn btn-danger my-2">{{$date_jp}} スケジュール確認</a>
                </div>
                {{-- <hr/>
                 <div class="row justify-content-center">
                   <button class="btn btn-primary" data-toggle="modal" data-target="#samples-{{$company->id}}">予約をする</button>
                    <div class="modal fade" id="samples-{{$company->id}}" tabindex="-1" role="dialog" aria- 
                    labelledby="demoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <form action="teacher/{{$company->id}}" method="post">
                            <div class="modal-content">
                                
                                <div class="modal-body  text-center">
                                        <h4>レッスン予約</h4>
                                        <p>{{ date('H:i', strtotime($time))}} ~ {{ date('H:i', strtotime($time) + 1500 )}}</p>
                                         <p>Teacher Name : {{$company->name}}</p>
                                         <p>レッスン予約を行います</p>
                                          <p>よろしいですか？</p>

                                </div>
                                <div class="modal-footer">
                                    @method('DELETE')
                                    @csrf
                                    
                                    <button type="submit" class="btn btn-primary">はい</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
                
            </div>
        </div>
        {{-- details --}}
        <div class="row mt-2 ">
             @if(empty($teacher_images))
            <div class="container col-md-12 col-sm-12" style="height:500px;overflow:hidden">
            <img src="https://www.nuvali.ph/wp-content/themes/consultix/images/no-image-found-360x250.png" class="img-fluid" style="width:initial;height:initial; margin: 0 auto"/>
            </div>
            @else
            <div class="container col-md-12 col-sm-12 p-0" style="height:500px;overflow:hidden">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    @foreach( $teacher_images as $photo )
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                    @endforeach
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach( $teacher_images as $photo )
                        <div class="carousel-item  {{ $loop->first ? 'active' : '' }}">
                            <img class="d-block img-fluid " src="{{ asset('images/'.$photo->url) }}" alt="{{ $photo->url }}" style="width:initial;height:initial; margin: 0 auto">
                                
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon text-dark" aria-hidden="true"></span>
                        <span class="sr-only ">Previous</span>
                    </a>
                    <a class="carousel-control-next " href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon text-dark" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            @endif
        </div>
        <div class="row ">
             <div class="container col-md-12 col-sm-12 px-0">
                <table class="table table-striped table-hover table-bordered">
                <tbody>
                    <tr>
                        <td colspan="2" class="text-center">{{$teacher->name}}</td>
                    </tr>
                    <tr>
                        <td style="width: 100px">講師名</td>
                        <td>{{$teacher->name}}</td>
                    </tr>
                    <tr>
                        <td>ニックネーム</td>
                        <td>{{$teacher->nickname}}</td>
                    </tr>
                    <tr>
                        <td>メッセージ</td>
                        <td>{{-- {{$teacher->profile}} --}} <span class="pt-5 pb-5"><pre style="white-space: pre-wrap">{{$teacher->message_students}}</pre></span></td>
                    </tr>
                    <tr>
                        <td>スタッフより</td>
                        <td>{{-- {{$teacher->profile}} --}} <span class="pt-5 pb-5"><pre style="white-space: pre-wrap">{{$teacher->message_admin}}</pre></span></td>
                    </tr>
        
                                <tr>
                                        <td class="align-middle">得意分野</td>
                                        <td class="p-1 m-0 pb-2" style="width: 400px">
                                            <table>
                                                <tr>
                                                    <td style="width: 50%">初心者向け</td>
                                                    <td style="width: 50%">
                                                        
                                                        @if($teacher->beginner == 'circle')
                                                        <div class="form-check form-check-inline">
                                                        <label class="form-check-label" for="inlineRadio1">
                                                            <span class="text-info">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                            <circle cx="8" cy="8" r="8"/>
                                                            </svg>
                                                            </span>
                                                        </label>
                                                         @endif
                                                        </div>
                                                        
                                                        @if($teacher->beginner == 'triangle')
                                                        <div class="form-check form-check-inline">
                                                        <label class="form-check-label" for="inlineRadio2">
                                                            <span class="text-warning">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z"/>
                                                            </svg>
                                                            </span>
                                                        </label>
                                                        @endif
                                                        @if($teacher->beginner == 'times')
                                                        <div class="form-check form-check-inline">
                                                        <label class="form-check-label" for="inlineRadio3">
                                                            <span class="text-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                            </svg>
                                                            </span>
                                                        </label>
                                                        </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>試験対策</td>
                                                    <td style="width: 50%">
                                                        @if($teacher->exam== 'circle')
                                                        <div class="form-check form-check-inline">
                                                        <label class="form-check-label" for="inlineRadio1">
                                                            <span class="text-info">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                            <circle cx="8" cy="8" r="8"/>
                                                            </svg>
                                                            </span>
                                                        </label>
                                                        </div>
                                                        @endif
                                                        @if($teacher->exam == 'triangle')
                                                        <div class="form-check form-check-inline">
                                                        
                                                        
                                                        
                                                        <label class="form-check-label" for="inlineRadio2">
                                                            <span class="text-warning">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z"/>
                                                            </svg>
                                                            </span>
                                                        </label>
                                                        </div>
                                                        @endif
                                                         @if($teacher->exam == 'times')
                                                        <div class="form-check form-check-inline">
                                                       
                                                       
                                                        
                                                        <label class="form-check-label" for="inlineRadio3">
                                                            <span class="text-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                            </svg>
                                                            </span>
                                                        </label>
                                                        </div>
                                                         @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>日常会話</td>
                                                    <td style="width: 300px">
                                                        @if($teacher->conversation == 'circle')
                                                         <div class="form-check form-check-inline">
                                                        <label class="form-check-label" for="inlineRadio1">
                                                            <span class="text-info">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                            <circle cx="8" cy="8" r="8"/>
                                                            </svg>
                                                            </span>
                                                        </label>
                                                         </div>
                                                          @endif
                                                        
                                                        @if($teacher->conversation == 'triangle')
                                                        <div class="form-check form-check-inline">
                                                        
                                                        
                                                        
                                                        <label class="form-check-label" for="inlineRadio2">
                                                            <span class="text-warning">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z"/>
                                                            </svg>
                                                            </span>
                                                        </label>
                                                        </div>
                                                        @endif
                                                         @if($teacher->conversation == 'times')
                                                        <div class="form-check form-check-inline">
                                                        
                                                       
                                                        
                                                        <label class="form-check-label" for="inlineRadio3">
                                                            <span class="text-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                            </svg>
                                                            </span>
                                                        </label>
                                                        </div>
                                                         @endif
                                                    </td>
                                                </tr>
                                               
                                            </table>
                                        </td>
                                </tr>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
     </div>
 </div>
 
 @endsection