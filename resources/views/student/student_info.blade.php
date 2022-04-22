 @extends('layout.student_layout')
 @section('content')
 {{--
Teachers Profile Page

 
 --}}
 <div class="col-md-8 col-sm-12 clearfix p-5">
    
         <form action="/student/update" method="POST">
         @csrf
        <div class="d-flex justify-content-between ">
            <a href="/student" class=" text-dark pr-1 "><i class="fas fa-3x fa-caret-left text-secondary"></i> </a>
            <h3 class="clearfix" >プロフィール</h3>
            <input type="submit" class="btn btn-primary float-right mb-2" value="更新" />
        </div>
     
         <input type="hidden" name="id" value="{{$student->id}}" /></td>
         <table class="table table-striped table-hover table-bordered bg-light">
             <tbody>
                 <tr>
                                    <td style="width: 150px">ID</td>
                                    <td><input type="text" name="sid" class="form-control .input"  value="{{$student->sid}}" {{-- maxlength="5" --}}
                                                oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                                    oninput="this.setCustomValidity('')"
                                                required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>パスワード </td>
                                        <td><input type="password" name="spass" class="form-control" i onChange="halfWidth(this)" value="{{$student->spass}}" 
                                        oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                        oninput="this.setCustomValidity('')"
                                        required/>
                                        </td>
                                </tr>
                                <tr>
                                    <td>{{-- タクシー会社名 --}} ニックネーム</td>
                                        <td><input type="text" name="jp_name" class="form-control .input"  value="{{$student->jp_name}}"
                                            oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                            oninput="this.setCustomValidity('')"
                                            required/>
                                        </td>

                                </tr>
                                <tr>
                                    <td>{{-- タクシー会社名 --}} ニックネーム(English)</td>
                                        <td><input type="text" name="eng_name" class="form-control .input"  value="{{$student->eng_name}}"
                                            oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                            oninput="this.setCustomValidity('')"
                                            required/>
                                        </td>

                                </tr>
                                 <tr>
                                    <td>メールアドレス</td>
                                        <td><input type="email" name="email" class="form-control .input"  value="{{$student->email}}"
                                        oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                        oninput="this.setCustomValidity('')"
                                        required/></td>
                                </tr>
                                 <tr>
                                    <td>コース {{--  〇〇コース --}}</td>
                                        <td><input type="text" name="course" class="form-control .input"  value="{{$student->course}}"
                                        oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                        oninput="this.setCustomValidity('')"
                                        disabled/></td>
                                </tr>

     </tbody>
     </table>
     <div class="d-flex justify-content-between align-items-center">
     <span class="align-middle">※コース変更、退会の場合は事務局までお問い合わせください。</span><span ><input type="submit" class="btn btn-primary " value="更新" /></span>
     </div>  
    </div>


 @endsection