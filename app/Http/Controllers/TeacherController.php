<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Teacher;
use App\Models\TeacherImages;
use App\Models\TeacherStatus;
use App\Models\BusinessHours;
use Illuminate\Support\Facades\DB;
use stdClass;
class TeacherController extends Controller
{
   
    public function login(){
        return view('teacher.login');
    }

    public function checkLogin(Request $request){

        $request->validate([
            'tid' => ['required'],
            'tpass' => ['required']
        ]);

        $user = Teacher::where('tid', $request->tid)->where('tpass', $request->tpass)->first();
        if (!empty($user)) {
            $request->session()->put('tid', $user->tid);
            $request->session()->put('name', $user->name);
            $request->session()->put('id', $this->encode($user->id));
            $request->session()->put('dec_id', $user->id);
            $request->session()->save();
            return redirect('/teacher');
        } else {
            return redirect('teacher/login')->with('message', 'ID又はパスワードの入力に誤りがあります。')->with('success', false);
        }
    }

    public function index(){
        if (!session()->has('tid')) {
            return redirect('teacher/login');
        } else {
            $tid = session()->get('tid');
            $check_tid = Teacher::Where('tid', $tid)->first();
            if (!$check_tid) {
                Session::flush();
                return redirect('teacher/login');
            }
        }
        $id = session()->get('id');        
        return view('teacher.index', compact('id'));
    }

    public function logout(){
        Session::flush();
        return redirect('teacher/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if (session()->get('id') != $id) {
            Session::flush();
            return redirect('teacher/login');
        }
        $id = $this->decode($id);
        $teacher = Teacher::with('business_hours')->where('id', $id)->first();
        if (!isset($teacher->business_hours)) {
            $bh = new stdClass();
            $bh->monday_start = "";
            $bh->monday_end = "";
            $bh->tuesday_start = "";
            $bh->tuesday_end = "";
            $bh->wednesday_start = "";
            $bh->wednesday_end = "";
            $bh->thursday_start = "";
            $bh->thursday_end = "";
            $bh->friday_start = "";
            $bh->friday_end = "";
            $bh->saturday_start = "";
            $bh->saturday_end = "";
            $bh->sunday_start = "";
            $bh->sunday_end = "";
        } else {
            $bh = $teacher->business_hours;
        }
        $teacher_images = TeacherImages::where('teacher_id', $id)->get();
        return view('teacher.teacher_info', compact('teacher', 'bh', 'teacher_images'));
    }

  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $data = $request->all();
        $teacher = Teacher::where('id', $data["id"])->first();
        $teacher->name = $data["name"];
        $teacher->tid = $data["tid"];
        $teacher->tpass = $data["tpass"];
        $teacher->email = $data["email"];
        $teacher->profile = $data["profile"];
        $teacher->message_students = $data["message_students"];
        $teacher->update();

        $bus_hours = BusinessHours::where('teacher_id', $data["id"])->first();
        if (!empty($bus_hours)) {
            $bus_hours->monday_start = $data["mon_start"];
            $bus_hours->monday_end = $data["mon_end"];
            $bus_hours->tuesday_start = $data["tue_start"];
            $bus_hours->tuesday_end = $data["tue_end"];
            $bus_hours->wednesday_start = $data["wed_start"];
            $bus_hours->wednesday_end = $data["wed_end"];
            $bus_hours->thursday_start = $data["thu_start"];
            $bus_hours->thursday_end = $data["thu_end"];
            $bus_hours->friday_start = $data["fri_start"];
            $bus_hours->friday_end = $data["fri_end"];
            $bus_hours->saturday_start = $data["sat_start"];
            $bus_hours->saturday_end = $data["sat_end"];
            $bus_hours->sunday_start = $data["sun_start"];
            $bus_hours->sunday_end = $data["sun_end"];
            $bus_hours->update();
        } else {
            $bus_hours = new BusinessHours();
            $bus_hours->monday_start = $data["mon_start"];
            $bus_hours->monday_end = $data["mon_end"];
            $bus_hours->tuesday_start = $data["tue_start"];
            $bus_hours->tuesday_end = $data["tue_end"];
            $bus_hours->wednesday_start = $data["wed_start"];
            $bus_hours->wednesday_end = $data["wed_end"];
            $bus_hours->thursday_start = $data["thu_start"];
            $bus_hours->thursday_end = $data["thu_end"];
            $bus_hours->friday_start = $data["fri_start"];
            $bus_hours->friday_end = $data["fri_end"];
            $bus_hours->saturday_start = $data["sat_start"];
            $bus_hours->saturday_end = $data["sat_end"];
            $bus_hours->sunday_start = $data["sun_start"];
            $bus_hours->sunday_end = $data["sun_end"];
            $bus_hours->teacher_id =  $data["id"];
            $bus_hours->save();
        }
        if ($request->file('file')) {
            $fileNames = array();
            foreach ($request->file('file') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path() . '/images/', $imageName);

                TeacherImages::create([
                    'url' => $imageName,
                    'teacher_id' => $request->id

                ]);
            }
        }

        //$images = json_encode($fileNames);

        // Store $images image in DATABASE from HERE 

        $current_images = TeacherImages::where('teacher_id', $request->id)->get();
        foreach ($current_images as $value) {
            $fileNames[] = $value->url;
        }
        return redirect()->back()->with('message', '更新完了しました。')->with('success', true);
    }
    public function availableSlot()
    {
        if (!session()->has('tid')) {
            return redirect('teacher/login');
        } else {
            $tid = session()->get('tid');
            $check_tid = Teacher::Where('tid', $tid)->first();
            if (!$check_tid) {
                Session::flush();
                return redirect('teacher/login');
            }
        }
        return view('teacher.booking');
    }

    public function slotDetailDate($id, $date)
    {
        
        if (session()->get('id') != $id) {
            Session::flush();
            return redirect('care-taxi/login');
        }
        if (!session()->has('tid')) {
            return redirect('care-taxi/login');
        } else {
            $tid = session()->get('tid');
            $check_tid = Teacher::Where('tid', $tid)->first();
            if (!$check_tid) {
                Session::flush();
                return redirect('care-taxi/login');
            }
        }
        $enc_id = $id;
        $id = $this->decode($id);
        $time = array();
        $teacher = Teacher::with('business_hours')->where('id', $id)->first();
        $previous_date =  date('Y-m-d', strtotime($date . ' -1 day'));
        $next_date = date('Y-m-d', strtotime($date . ' +1 day'));

        if ($teacher->business_hours) {
            $bus_hours = $teacher->business_hours;
            $day = date('l', strtotime($date));
            /*  $time_start = "00:00";
            $time_end = "23:30"; */
            $time_start = null;
            $time_end = null;
            $has_no_schedule = 0;
            if ($day == "Monday") {
                $time_start = $bus_hours->monday_start;
                $time_end = $bus_hours->monday_end;
            } else if ($day == "Tuesday") {
                $time_start = $bus_hours->tuesday_start;
                $time_end   = $bus_hours->tuesday_end;
            } else if ($day == "Wednesday") {
                $time_start = $bus_hours->wednesday_start;
                $time_end   = $bus_hours->wednesday_end;
            } else if ($day == "Thursday") {
                $time_start = $bus_hours->thursday_start;
                $time_end   = $bus_hours->thursday_end;
            } else if ($day == "Friday") {
                $time_start = $bus_hours->friday_start;
                $time_end   = $bus_hours->friday_end;
            } else if ($day == "Saturday") {
                $time_start = $bus_hours->saturday_start;
                $time_end   = $bus_hours->saturday_end;
            } else if ($day == "Sunday") {
                $time_start = $bus_hours->sunday_start;
                $time_end   = $bus_hours->sunday_end;
            } else {
                $has_no_schedule = 1;
                $time_start = "00:00";
                $time_end = "00:00";
            }

            $teacher_status = TeacherStatus::Where('teacher_id', $id)->where('date', $date)->get();

            if (count($teacher_status) == 0) {

                $status = "circle";
                $comment = "";
                $curr_time = $date . ' ' . $time_start;
                array_push($time, [
                    'time' => date('h:ia', strtotime($curr_time)),
                    'status' => $status,
                    'comment' => $comment,
                ]);
                $current = strtotime($curr_time);
                $start = strtotime($date . ' ' . $time_start);
                $end = strtotime($date . ' ' . $time_end);
                //add this to adjust the last time in the list.
                $end = strtotime("-30 minutes", $end); 
                //
                while ($current >= $start && $current < $end) {
                    $added_time = strtotime("+30 minutes", $current);
                    if ($added_time < $end) {

                        array_push($time, [
                            'time' => date('h:ia', $added_time),
                            'status' => $status,
                            'comment' => $comment,
                        ]);
                    } else {
                        array_push($time, [
                            'time' => date('h:ia', $end),
                            'status' => $status,
                            'comment' => $comment,
                        ]);
                        break;
                    }
                    $current = $added_time;
                }
            } else {

                $status = "circle";
                $comment = "";
                $curr_time = $date . ' ' . $time_start;
                foreach ($teacher_status as $teacher) {

                    if ($teacher->time == date('h:ia', strtotime($curr_time))) {
                        $status = $teacher->status;
                        $comment = $teacher->comment;
                        break;
                    }
                }
                array_push($time, [
                    'time' => date('h:ia', strtotime($curr_time)),
                    'status' => $status,
                    'comment' => $comment,
                ]);
                $current = strtotime($curr_time);
                $start = strtotime($date . ' ' . $time_start);
                $end = strtotime($date . ' ' . $time_end);

                while ($current >= $start && $current < $end) {
                    $added_time = strtotime("+30 minutes", $current);
                    if ($added_time < $end) {

                        foreach ($teacher_status as $teacher) {

                            if ($teacher->time == date('h:ia', $added_time)) {
                                $status = $teacher->status;
                                $comment = $teacher->comment;
                                break;
                            }
                        }
                        array_push(
                            $time,
                            [
                                'time' => date('h:ia', $added_time),
                                'status' => $status,
                                'comment' => $comment,

                            ]
                        );
                    } else {
                        foreach ($teacher_status as $teacher) {
                            if ($teacher->time == date('h:ia', $added_time)) {
                                $status = $teacher->status;
                                $comment = $teacher->comment;
                                break;
                            }
                        }
                        array_push($time, [
                            'time' => date('h:ia', $end),
                            'status' => $status,
                            'comment' => $comment,
                        ]);
                        break;
                    }
                    $current = $added_time;
                }
            }
        }
        $not_current = true;
        if ($date == date('Y-m-d')) {
            $not_current = false;
        }

        $dy  = date("w", strtotime($date));
        $dys = array("日", "月", "火", "水", "木", "金", "土");
        $dyj = $dys[$dy];
        $date_jp = date('Y年m月d日', strtotime($date));
        $date_jp = $date_jp . '(' . $dyj . ')';
        $this_time_str = strtotime(date("H:i"));

        return view('teacher.show_status', compact('this_time_str', 'time', 'date', 'teacher', 'id', 'enc_id', 'previous_date', 'next_date', 'not_current', 'date_jp', 'has_no_schedule'));
    }

    public function editDetailDate($id, $date)
    {
        if (session()->get('id') != $id) {
            Session::flush();
            return redirect('teacher/login');
        } else {
            $tid = session()->get('tid');
            $check_tid = Teacher::Where('tid', $tid)->first();
            if (!$check_tid) {
                Session::flush();
                return redirect('teacher/login');
            }
        }
        $enc_id = $id;
        $id = $this->decode($id);
        $teacher = Teacher::with('business_hours')->where('id', $id)->first();
        $previous_date =  date('Y-m-d', strtotime($date . ' -1 day'));
        $next_date = date('Y-m-d', strtotime($date . ' +1 day'));
        $bus_hours = $teacher->business_hours;
        $day = date('l', strtotime($date));
        $time = array();
        $time_start = null;
        $time_end = null;
        $has_no_schedule = false;
        if (
            $day == "Monday"
        ) {
            $time_start = $bus_hours->monday_start;
            $time_end = $bus_hours->monday_end;
        } else if ($day == "Tuesday") {
            $time_start = $bus_hours->tuesday_start;
            $time_end   = $bus_hours->tuesday_end;
        } else if ($day == "Wednesday") {
            $time_start = $bus_hours->wednesday_start;
            $time_end   = $bus_hours->wednesday_end;
        } else if ($day == "Thursday") {
            $time_start = $bus_hours->thursday_start;
            $time_end   = $bus_hours->thursday_end;
        } else if ($day == "Friday") {
            $time_start = $bus_hours->friday_start;
            $time_end   = $bus_hours->friday_end;
        } else if ($day == "Saturday") {
            $time_start = $bus_hours->saturday_start;
            $time_end   = $bus_hours->saturday_end;
        } else if ($day == "Sunday") {
            $time_start = $bus_hours->sunday_start;
            $time_end   = $bus_hours->sunday_end;
        } else {
            $time_start = "00:00";
            $time_end = "00:00";
            $has_no_schedule = true;
        }
        //$time_start = "00:00";
        //$time_end = "23:30";

        $teacher_status = TeacherStatus::Where('teacher_id', $id)->where('date', $date)->get();

        if (empty($teacher_status)) {
            //default status
            $status = "circle";
            $comment = "";
            $curr_time = $date . ' ' . $time_start;
            array_push($time, [
                'time' => date('h:ia', strtotime($curr_time)),
                'status' => $status,
                'comment' => $comment,
            ]);
            $current = strtotime($curr_time);
            $start = strtotime($date . ' ' . $time_start);
            $end = strtotime($date . ' ' . $time_end);
            //add this to adjust the last time in the list.
            $end = strtotime("-30 minutes", $end); 
                //

            while ($current >= $start && $current < $end) {
                $added_time = strtotime("+30 minutes", $current);
                if ($added_time < $end) {
                    array_push($time, [
                        'time' => date('h:ia', $added_time),
                        'status' => $status,
                        'comment' => $comment,
                    ]);
                } else {
                    array_push($time, [
                        'time' => date('h:ia', $end),
                        'status' => $status,
                        'comment' => $comment,
                    ]);
                    break;
                }
                $current = $added_time;
            }
        } else {

            //default status
            $status = "circle";
            $comment = "";
            $curr_time = $date . ' ' . $time_start;
            foreach ($teacher_status as $teacher) {

                if ($teacher->time == date('h:ia', strtotime($curr_time))) {
                    $status = $teacher->status;
                    $comment = $teacher->comment;
                    break;
                }
            }
            array_push($time, [
                'time' => date('h:ia', strtotime($curr_time)),
                'status' => $status,
                'comment' => $comment,
            ]);
            $current = strtotime($curr_time);
            $start = strtotime($date . ' ' . $time_start);
            $end = strtotime($date . ' ' . $time_end);

            while ($current >= $start && $current < $end) {
                $added_time = strtotime("+30 minutes", $current);
                if ($added_time < $end) {

                    foreach ($teacher_status as $teacher) {

                        if ($teacher->time == date('h:ia', $added_time)) {
                            // var_dump($teacher->status);
                            $status = $teacher->status;
                            $comment = $teacher->comment;
                            break;
                        }
                    }
                    array_push(
                        $time,
                        [
                            'time' => date('h:ia', $added_time),
                            'status' => $status,
                            'comment' => $comment,

                        ]
                    );
                } else {
                    foreach ($teacher_status as $teacher) {
                        if ($teacher->time == date('h:ia', $added_time)) {
                            $status = $teacher->status;
                            $comment = $teacher->comment;
                            break;
                        }
                    }
                    array_push($time, [
                        'time' => date('h:ia', $end),
                        'status' => $status,
                        'comment' => $comment,
                    ]);
                    break;
                }
                $current = $added_time;
            }
        }
        //die;
        $not_current = true;
        if ($date == date('Y-m-d')) {
            $not_current = false;
        }
        $dy  = date("w", strtotime($date));
        $dys = array("日", "月", "火", "水", "木", "金", "土");
        $dyj = $dys[$dy];
        $date_jp = date('Y年m月d日', strtotime($date));
        $date_jp = $date_jp . '(' . $dyj . ')';
        $this_time_str = strtotime(date("H:i"));
        /* return response()->json(array(
            'success' => true,
            'data'   => $teacher_status,
            'day'    => $time,
        ));  */
        return view('teacher.update_status', compact('this_time_str', 'time', 'date', 'teacher', 'id','enc_id','not_current', 'previous_date', 'next_date', 'date_jp', 'has_no_schedule'));
    }

    public function statusUpdate(Request $request)
    {
        if (!session()->has('tid')) {
            Session::flush();
            return redirect('teacher/login');
        }

        $data = array();
        $current_date = $request->get('date');
        $teacher_id =  $request->get('id');

        foreach ($request->all() as $key => $value) {
            if ($key != "_token" && $key != 'date' && $key != 'id') {
                $time = explode('-', $key);
                if (count($time) > 1) {
                    $status = 'status-' . $time[1];
                    $comment = 'comment-' . $time[1];
                    if ($key == $status) {
                        $teacher_status = TeacherStatus::Where('teacher_id', $teacher_id)->where('date', $current_date)->where('time', $time[1])->first();
                        if (!empty($teacher_status->id)) {
                            //$com_status = teacherStatus::Where('teacher_id', $teacher_id)->delete();

                            DB::table('teacher_status')->Where('teacher_id', $teacher_id)->delete();
                            /* $teacher_status->time =  $time[1];
                            $teacher_status->status = $request->get($status);
                            $teacher_status->comment = $request->get($comment);
                            $teacher_status->update(); */
                            $teacher_status = new TeacherStatus();
                            $teacher_status->time = date("h:ia", strtotime($time[1]));
                            $teacher_status->status = $request->get($status);
                            $teacher_status->comment = $request->get($comment);
                            $teacher_status->teacher_id = $teacher_id;
                            $teacher_status->date = $current_date;
                            $teacher_status->save();
                        } else {
                            $teacher_status = new TeacherStatus();
                            $teacher_status->time = date("h:ia", strtotime($time[1]));
                            $teacher_status->status = $request->get($status);
                            $teacher_status->comment = $request->get($comment);
                            $teacher_status->teacher_id = $teacher_id;
                            $teacher_status->date = $current_date;
                            $teacher_status->save();
                        }
                    }
                }
            }
        }
        //die;
        return redirect()->back()->with('message', '更新完了しました。')->with('success', true);
    }


}
