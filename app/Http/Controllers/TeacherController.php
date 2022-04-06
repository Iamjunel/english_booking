<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Teacher;
use App\Models\TeacherImages;
use App\Models\BusinessHours;

use stdClass;
class TeacherController extends Controller
{
    public function login()
    {
        return view('teacher.login');
    }

    public function checkLogin(Request $request)
    {

        $request->validate([
            'tid' => ['required'],
            'tpass' => ['required']
        ]);

        $user = Teacher::where('tid', $request->tid)->where('tpass', $request->tpass)->first();
        if (!empty($user)) {
            $request->session()->put('tid', $user->tid);
            $request->session()->put('name', $user->name);
            $request->session()->put('id', $this->encode($user->id));
            $request->session()->save();
            return redirect('/teacher');
        } else {
            return redirect('teacher/login')->with('message', 'ID又はパスワードの入力に誤りがあります。')->with('success', false);
        }
    }

    public function index()
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
        $id = session()->get('id');        
        return view('teacher.index', compact('id'));
    }

    public function logout()
    {
        Session::flush();
        return redirect('teacher/login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    public function update(Request $request)
    {
        $data = $request->all();
        $company = Teacher::where('id', $data["id"])->first();
        $company->name = $data["name"];
        $company->tid = $data["tid"];
        $company->tpass = $data["tpass"];
        $company->email = $data["email"];
        $company->profile = $data["profile"];
        $company->message_students = $data["message_students"];
        $company->update();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
