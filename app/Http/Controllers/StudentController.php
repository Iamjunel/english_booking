<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use Illuminate\Support\Facades\Session;
use App\Models\Teacher;
use App\Models\TeacherImages;
use App\Models\TeacherStatus;
use App\Models\BusinessHours;
class StudentController extends Controller
{

    public function checkLogin(Request $request){

        $request->validate([
            'sid' => ['required'],
            'spass' => ['required']
        ]);

        $user = Student::where('sid', $request->sid)->where('spass', $request->spass)->first();
        
           if (!empty($user)) {
            $request->session()->put('sid', $request->sid);
            $request->session()->put('name', $request->sid);
            $request->session()->put('id', $request->id);
            $request->session()->save();
            return redirect('/student');
        } else {
            return redirect('student/login')->with('message', 'ID又はパスワードの入力に誤りがあります。')->with('success', false);
        }
    }
    public function login(){
        return view('student.login');
    }
    public function logout(){
        Session::flush();
        return redirect('student/login');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (!session()->has('sid')) {
            return redirect('student/login');
        } else {
            $sid = session()->get('sid');
        }
        return view('student.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){

        $data = $request->all();
        $student = Student::where('id', $data["id"])->first();
        $student->name = $data["name"];
        $student->sid = $data["sid"];
        $student->email = $data["email"];
        $student->jp_name = $data["jp_name"];
        $student->eng_name = $data["eng_name"];
        $student->update();

        return redirect()->back()->with('message', 'Record updated successfully.')->with('success', true);
    }

    public function availableSlot()
    {
        if (!session()->has('sid')) {
            return redirect('student/login');
        } else {
            $sid = session()->get('sid');
        }
        return view('student.available_slot');
    }

    public function getAllTeacher()
    {
        if (!session()->has('sid')) {
            return redirect('student/login');
        } else {
            $sid = session()->get('sid');
        }

        $day = strtolower(date('l'));
        $teacher = Teacher::with('business_hours')->orderBy('id')->get();
        foreach ($teacher as $value) {
            $value["enc_id"] = $this->encode($value->id);
        }
        return view('student.teacher_list', compact('teacher', 'day'));
    }

    public function getTeacherDetail($id)
    {
        $id = $this->decode($id);
        if (!session()->has('sid')) {
            return redirect('student/login');
        }
        /*  $company = Company::with('business_hours')->where('id',$id)->first();
        $company_images = CompanyImages::where('company_id',$id)->get();
        return view('user.company_detail',compact('company','company_images')); */
        $teacher = Teacher::with('business_hours')->where('id', $id)->first();
        if ($teacher->business_hours == null) {
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
        return view('student.teacher_detail', compact('teacher', 'bh', 'teacher_images'));
    }
    public function getStudentHistory()
    {
        if (!session()->has('sid')) {
            return redirect('student/login');
        } else {
            $sid = session()->get('sid');

        }
        $day = strtolower(date('l'));
        /* 
        $teacher = Teacher::with('business_hours')->orderBy('id')->get();
        foreach ($teacher as $value) {
            $value["enc_id"] = $this->encode($value->id);
        } */
        $teacher = null;

        return view('student.history', compact('teacher', 'day'));
    }
    public function getStudentInfoById()
    {
        if (!session()->has('sid')) {
            return redirect('student/login');
        } else {
            $sid = session()->get('sid');
        }
        $student = Student::where('sid', $sid)->first();

        return view('student.student_info', compact('student'));
    }

    public function availableSlotDetailDate($date)
    {
        if (!session()->has('sid')) {
            return redirect('student/login');
        }

        $time = array();

        $time_start = null;
        $time_end = null;

        $company = Teacher::orderBy('id')->get();

        $time_start = "10:00";
        $time_end = "23:30";
        $curr_time = $date . ' ' . $time_start;
        array_push($time, [
            'time' => date('h:ia', strtotime($curr_time))
        ]);
        $current = strtotime($curr_time);
        $start = strtotime($date . ' ' . $time_start);
        $end = strtotime($date . ' ' . $time_end);

        while ($current >= $start && $current < $end) {
            $added_time = strtotime("+30 minutes", $current);
            if ($added_time < $end) {

                array_push($time, [
                    'time' => date('h:ia', $added_time),
                ]);
            } else {
                array_push($time, [
                    'time' => date('h:ia', $end),
                ]);
                break;
            }
            $current = $added_time;
        }


        $previous_date =  date('Y-m-d', strtotime($date . ' -1 day'));
        $next_date = date('Y-m-d', strtotime($date . ' +1 day'));
        $not_current = true;

        if (
            $date <= date('Y-m-d')
        ) {
            $not_current = false;
        }
        $this_date = date("H:i");
        $this_date_str = strtotime(date("H:i"));
        $dy = date("w", strtotime($date));

        $dys = array("日", "月", "火", "水", "木", "金", "土");
        $dyj = $dys[$dy];

        $date_jp = date('Y年m月d日', strtotime($date));
        $date_jp = $date_jp . '(' . $dyj . ')';

        $day = date('l', strtotime($date));
        for ($count = 0; $count < count($time); $count++) {
            foreach ($company as $com) {
                $this_time = $time[$count]["time"];
                $company_status = TeacherStatus::Where('teacher_id', $com->id)->where('date', $date)->where('time', $this_time)->first();
                $bus_hours = BusinessHours::where('teacher_id', $com->id)->first();
                if ($bus_hours) {

                    if ($day == "Monday") {
                        $curr_start_time = $bus_hours->monday_start;
                        $curr_end_time = $bus_hours->monday_end;
                    } else if ($day == "Tuesday") {
                        $curr_start_time = $bus_hours->tuesday_start;
                        $curr_end_time = $bus_hours->tuesday_end;
                    } else if ($day == "Wednesday") {
                        $curr_start_time = $bus_hours->wednesday_start;
                        $curr_end_time = $bus_hours->wednesday_end;
                    } else if ($day == "Thursday") {
                        $curr_start_time = $bus_hours->thursday_start;
                        $curr_end_time = $bus_hours->thursday_end;
                    } else if ($day == "Friday") {
                        $curr_start_time = $bus_hours->friday_start;
                        $curr_end_time = $bus_hours->friday_end;
                    } else if ($day == "Saturday") {
                        $curr_start_time = $bus_hours->saturday_start;
                        $curr_end_time = $bus_hours->saturday_end;
                    } else if ($day == "Sunday") {
                        $curr_start_time = $bus_hours->sunday_start;
                        $curr_end_time = $bus_hours->sunday_end;
                    }
                    $within_range = false;
                    $within_time_range = false;
                    if ($curr_start_time != null && $curr_end_time != null) {
                        $on_time = date('h:i a');
                        $start = strtotime(date('Y-m-d h:i a', strtotime($date . ' ' . $curr_start_time)));
                        $end =  strtotime(date('Y-m-d h:i a', strtotime($date . ' ' . $curr_end_time)));
                        $current_time =  strtotime(date('Y-m-d h:i a', strtotime($date . ' ' . $this_time)));
                        $current_time_range =  strtotime(date('Y-m-d h:i a'));
                        /* var_dump(date('Y-m-d h:i a', strtotime($date . ' ' . $this_time)));
                    var_dump(date('Y-m-d h:i a', strtotime($date . ' ' . $on_time)));die; */
                        // $within_range = true;
                        // $within_time_range = true;
                        if ($current_time >= $start && $current_time <= $end) {
                            $within_range = true;
                            if ($current_time >= $current_time_range) {
                                $within_time_range = true;
                            }
                        }
                    }


                    /* if (isset($company_status->status) && $within_time_range) {
                        $com_list[] = $com;
                        $time[$count]["status_" . $com->id] = $company_status->status;
                    } else */
                    if (isset($company_status->status) &&  $this_date_str < strtotime($this_time)) {
                        $com_list[] = $com;
                        $time[$count]["status_" . $com->id] = $company_status->status;
                    } else if ($this_date_str > strtotime($this_time) && $date == date('Y-m-d')) {
                        $com_list[] = $com;
                        //default status if within range
                        /*  $time[$count]["status_" . $com->id] = 'circle'; */
                        $time[$count]["status_" . $com->id] = 'times';
                        // $time[$count]["status_" . $com->id] = 'times';

                    } else if ($within_range && $within_time_range) {
                        $com_list[] = $com;
                        //default status if within range
                        /*  $time[$count]["status_" . $com->id] = 'circle'; */
                        if (isset($company_status->status)) {
                            $time[$count]["status_" . $com->id] = $company_status->status;
                        } else {
                            $time[$count]["status_" . $com->id] = 'circle';
                        }

                        // $time[$count]["status_" . $com->id] = 'times';
                    } else {
                        $com_list[] = $com;
                        $time[$count]["status_" . $com->id] = 'times';
                    }
                } else {
                    $time[$count]["status_" . $com->id] = null;
                }
            }
        }

        $comp_list = array();
        foreach ($company as $com_list) {
            $name = 'status_' . $com_list->id;
            $com_list["enc_id"] = $this->encode($com_list->id);
            foreach ($time as $t) {
                if (isset($t[$name]) && $t[$name] == 'circle') {
                    $comp_list[] = $com_list;
                    break;
                }
            }
        }
        /*  return response()->json(array(
            'success' => true,
            'time' => $time,
            'companies'    => $comp_list
        ));  */

        return view('student.slot_detail_date', compact('time', 'date', 'company', 'previous_date', 'next_date', 'not_current', 'date_jp', 'comp_list', 'this_date'));
    }
    
}
