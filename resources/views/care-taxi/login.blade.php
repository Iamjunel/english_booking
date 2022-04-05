@extends('layout.taxi_layout')
 @section('content')
    {{--    
        English Teacher Login

 --}}
     <div className="col-md-12 col-sm-12 clearfix">
                        <h3>Think English login</h3>
                        <form action="/care-taxi/checklogin" method="POST">
                            @csrf
                            
                            <div class="mb-2">
                                <label class="form-label">ID:</label>
                                <input type="type" name="cid" class="form-control" id="exampleInputEmail2" value="" oninvalid="this.setCustomValidity('このフィールドを入力してください。')"
    oninput="this.setCustomValidity('')" required/>
                            </div>
                            <div className="mb-2">
                                <label class="form-label">パスワード:</label>
                                <input type="password" name="cpass" class="form-control" id="exampleInputPassword1" value="" oninvalid="this.setCustomValidity('このフィールドを入力してください。')"
    oninput="this.setCustomValidity('')" required/>
                            </div>
                            <div class="mb-2 mt-2">
                                <input type="submit" class="btn btn-block btn-secondary text-center" value="ログインする" />
                            </div>
                        </form>
                    </div>
                
 @endsection