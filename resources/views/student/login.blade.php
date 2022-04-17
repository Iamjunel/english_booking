@extends('layout.student_layout')
 @section('content')
     <div className="col-md-12 col-sm-12 clearfix">
                        <h3>ユーザーログイン</h3>
                        <form action="/student/checklogin" method="POST">
                            @csrf
                            
                            <div class="mb-2">
                                <label class="form-label">ID:</label>
                                <input type="type" name="sid" class="form-control" value="" oninvalid="this.setCustomValidity('このフィールドを入力してください。')"
    oninput="this.setCustomValidity('')" required/>
                            </div>
                            <div className="mb-2">
                                <label class="form-label">パスワード:</label>
                                <input type="password" name="spass" class="form-control" value="" oninvalid="this.setCustomValidity('このフィールドを入力してください。')"
    oninput="this.setCustomValidity('')" required/>
                            </div>
                            <div class="mb-2 mt-2">
                                <input type="submit" class="btn btn-block btn-secondary text-center " value="ログインする"/>
                            </div>
                            
                        </form>
                    </div>
 
 @endsection