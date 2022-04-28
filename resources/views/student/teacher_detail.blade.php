 @extends('layout.student_layout')
 @section('content')
 <div class="container">
     <div class="col-md-12 col-sm-12 clearfix">
         
         <div class="d-flex justify-content-between align-items-center px-0 ">
            <a href="/student" class=" text-dark "><i class="fas fa-3x fa-caret-left text-secondary"></i> </a>
            <h3 class="clearfix" >{{$teacher->name}}</h3>
            <a href="/student/slot/detail/{{$teacher->id}}/{{date('Y-m-d', strtotime('last monday'))}}" class="btn btn-danger align-middle ">空き状況を見る</a>
        </div>
        <div class="row border ">
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
        <div class="row">
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