<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use Illuminate\Support\Facades\Session;
use App\Models\Teacher;
use App\Models\TeacherImages;
class StudentController extends Controller
{

    public function checkLogin(Request $request){

        $request->validate([
            'sid' => ['required'],
            'spass' => ['required']
        ]);

        if ($request->sid == "caretaku" && $request->spass == "caretaku113355") {
            $request->session()->put('sid', $request->sid);
            $request->session()->put('name', $request->sid);
            $request->session()->put('id', $request->sid);
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

            if ($sid != "caretaku") {
                Session::flush();
                return redirect('student/login');
            }
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
    public function update(Request $request, Student $student){
        //
    }

    public function availableSlot()
    {
        if (!session()->has('sid')) {
            return redirect('student/login');
        } else {
            $sid = session()->get('sid');

            if ($sid != "caretaku") {
                Session::flush();
                return redirect('student/login');
            }
        }
        return view('student.available_slot');
    }

    public function getAllTeacher()
    {
        if (!session()->has('sid')) {
            return redirect('student/login');
        } else {
            $sid = session()->get('sid');

            if ($sid != "caretaku") {
                Session::flush();
                return redirect('student/login');
            }
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

            if ($sid != "caretaku") {
                Session::flush();
                return redirect('student/login');
            }
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
}
