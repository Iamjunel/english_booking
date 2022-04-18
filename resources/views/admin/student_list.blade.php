 @extends('layout.admin_layout')
 @section('content')
{{-- 
    This page displays the list of the registered teachers.

  --}}
 <div class="container" >
     <div class="col-md-12 col-sm-12 clearfix">
         <div class="d-flex justify-content-between ">    
         <a href="/admin" class=" text-dark mr-2"><i class="fas fa-3x fa-caret-left text-secondary"></i></a>
        <h3 class="text-center" style="line-height: 1.85">講師一覧</h3>
        {{-- new registration --}}
        <a href="/admin/register" class="btn btn-light text-dark border-dark pb-0 mb-3 " style="line-height: 2.1;visibility:hidden">新規登録</a>
         </div>
        <table class="table table-striped table-hover table-bordered" >
        <thead>
            <tr class="text-center">
        
            <th>ニックネーム</th>
            <th>ID</th>
            <th>パスワード</th>
             <th>メールアドレス</th>
             <th>コース</th>
             <th>チケット数</th>
             <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student as $t)
            <form action ="/admin/student/update" method="POST">
                @csrf
                <input type="hidden" name="id" class="form-control .input"  value="{{$t->id}}" required/>
                <tr class="text-center">
                <td class="align-middle">{{$t->eng_name}}</td>
                <td class="align-middle">{{$t->sid}}</td>
                <td class="align-middle">{{$t->spass}}</td>
                <td class="align-middle">{{$t->email}}</td>
                <td style="width:150px"><input type="text" name="course" class="form-control .input"  value="{{$t->course}}"
                                            oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                            oninput="this.setCustomValidity('')"
                                            required/>
                </td>
                <td style="width:100px"><input type="number" name="ticket" class="form-control .input"  value="{{$t->ticket}}" maxlength="4"
                                            oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                            oninput="this.setCustomValidity('')"
                                            required/>
                </td>
                <td style="width:150px"><input type="text" name="memo" class="form-control .input"  value="{{$t->memo}}"
                                            oninvalid="this.setCustomValidity('必須事項が入力されていません。')"
                                            oninput="this.setCustomValidity('')"
                                            required/>
                </td>
                <td class="px-1 py-2" style="min-width:240px">
                    <button class="btn btn-info" type="submit">更新</button>
                    </form>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#sample-{{$t->id}}">削除</button>
                    <a href="/admin/student/{{$t->enc_id}}/history" class="btn btn-primary">レッスン履歴</a>
                </td>
            
            <div class="modal fade" id="sample-{{$t->id}}" tabindex="-1" role="dialog" aria- 
            labelledby="demoModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm" role="document">
                    <form action="student/{{$t->id}}" method="post">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="demoModalLabel">{{$t->name}}</h5>
								<button type="button" class="close" data-dismiss="modal" aria- 
                                label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
								<h4>この会社を削除してもよろしいですか？</h4>
						</div>
						<div class="modal-footer">
                            @method('DELETE')
                             @csrf
							<button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
						    <button type="submit" class="btn btn-primary">はい</button>
        
						</div>
					</div>
                    </form>
				</div>
			</div>
            </tr>
            @endforeach
            
            
        </tbody>
        </table>
     </div>
 </div>
 
 @endsection
 
