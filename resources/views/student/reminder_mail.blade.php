<!DOCTYPE html>
<html>
<body>
    @if($record['user'] == "student")
    <p>tittle:【レッスン1時間前のお知らせ】 Think English Learning Center</p>
    <hr/>
    <p>{{ $record['student_name'] }}様<br/>
       Think English Learning Centerをご利用いただきありがとうございます。</p>
    <p>レッスンの1時間前になりましたので、ご連絡いたします</p>
   

    <p>予約内容<br/>    
       日時: {{ $record['time'] }}<br/>
        講師: {{ $record['teacher_name'] }}</p>
    
    <p>レッスンURL</p>    
    <p>{{ $record['zoom'] }}<br/>
       ※予約時間1分前より入室可能です。 <br/>
       ※キャンセルまたは欠席する場合は、 事務局までご連絡ください。 <br/>
       (開始2時間以内の欠席連絡はレッスン1回とカウントされますのでご注意ください) </p>
    
    <p>マイページはこちら<br/>    
       <a href ="https://yoyaku.thinkenglish.jp/student/login" target="_blank">https://yoyaku.thinkenglish.jp/student/login</a></p>

    <p>※本メールアドレスは送信専用のため、返信できません。 <br/>
       ※このメールに関して心当たりのない方はお手数ではございますが、 以下までお問い合わ <br/>
      せください。 </p>
    
    <p>メールアドレス: 	think.english.learning.center@gmail.com<br/>    
       Think English Learning Center</p>

    @endif


    @if($record['user'] == "teacher")
    <p>title:【You will have a student  in 1 hour】 Think English Learning Center </p>
    <p>---------------------------------------------------------------</p>    
    <p>Date : {{ $record['time'] }}<br/>
       User : {{ $record['teacher_name'] }}</p>
    <p>Lesson URL : {{ $record['zoom'] }}</p>
    <p></p>
    @endif



    {{-- @if($record['user'] == "admin")
    <p>title: 【予約完了】 Think English Learning Center</p>
    <p>---------------------------------------------------------------</p>
    <p>予約內容</p>    
    <p>日時: {{ $record['time'] }}<br/>
       講師: {{ $record['teacher_name'] }}<br/>
       ユーザー: ユーザー名</p>

    <p>レッスンURL: {{ $record['zoom'] }}</p>
    <p></p>
    @endif --}}
</body>
</html>