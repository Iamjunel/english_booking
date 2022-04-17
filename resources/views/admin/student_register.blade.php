@extends('layout.admin_layout')
 @section('content')
    {{--    
        The registration is for the teachers.
 --}}
     <div className="col-md-12 col-sm-12 clearfix">
                    <div class="d-flex">    
                    <a href="/admin" class="text-center text-dark mr-2"><i class="fas fa-3x fa-caret-left text-secondary"></i></a>
                    <h3 class=" text-center"  style="line-height:1.8">{{-- 講師 --}}学生を登録する</h3>
                    </div>
                        <form accept-charset="U+FF66-U+FF9F" action="/admin/student/store" method="POST" >
                            @csrf
                            

                            <table class="table table-striped table-hover table-bordered bg-light">
                             <tbody>
                                <tr>
                                    <td style="width: 100px">ID</td>
                                    <td><input type="text" name="sid" class="form-control .input"  value="" maxlength="5"
                                                oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                                    oninput="this.setCustomValidity('')"
                                                required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>パスワード </td>
                                        <td><input type="password" name="spass" class="form-control" i onChange="halfWidth(this)" value="" 
                                        oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                        oninput="this.setCustomValidity('')"
                                        required/>
                                        </td>
                                </tr>
                                
                                <tr>
                                    <td>{{-- タクシー会社名 --}}名前</td>
                                        <td><input type="text" name="name" class="form-control .input"  value=""
                                        oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                        oninput="this.setCustomValidity('')"
                                        required/>
                                            {{-- <input type="hidden" name="name" value="{{$teacher->name}}"/> --}}
                                        </td>

                                </tr>
                                <tr>
                                    <td>{{-- タクシー会社名 --}} ニックネーム</td>
                                        <td><input type="text" name="jp_name" class="form-control .input"  value=""
                                            oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                            oninput="this.setCustomValidity('')"
                                            required/>
                                        </td>

                                </tr>
                                <tr>
                                    <td>{{-- タクシー会社名 --}} ニックネーム(English)</td>
                                        <td><input type="text" name="eng_name" class="form-control .input"  value=""
                                            oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                            oninput="this.setCustomValidity('')"
                                            required/>
                                        </td>

                                </tr>
                                 <tr>
                                    <td>メールアドレス</td>
                                        <td><input type="email" name="email" class="form-control .input"  value=""
                                        oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                        oninput="this.setCustomValidity('')"
                                        required/></td>
                                </tr>
                                 <tr>
                                    <td>コース {{--  〇〇コース --}}</td>
                                        <td><input type="text" name="course" class="form-control .input"  value=""
                                        oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                        oninput="this.setCustomValidity('')"
                                        required/></td>
                                </tr>
                                
                            </tbody>
                        </table>
                            <div class="mb-2 mt-2">
                                <input type="submit" class="btn btn-block btn-secondary text-center" value="登録" />
                            </div>
                        </form>
 
 @endsection