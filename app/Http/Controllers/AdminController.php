<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Teacher;
class AdminController extends Controller
{

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function login()
    {
        return view('admin.login');
    }
    public function index()
    {
        if (!session()->has('cid')) {
            return redirect('admin/login');
        }
        $id = session()->get('id');
        return view('admin.index');
    }

    public function checkLogin(Request $request){

        $request->validate([
            'tid' => ['required'],
            'tpass' => ['required']
        ]);

        if ($request->tid == "admin" && $request->tpass == "admin") {
            $request->session()->put('cid', 'admin');
            $request->session()->put('name', 'admin');
            $request->session()->put('id', 1);
            $request->session()->save();
            return redirect('/admin');
        } else {
            return redirect('admin/login')->with('message', 'ID又はパスワードの入力に誤りがあります。')->with('success', false);
        }
    }
    public function logout()
    {
        Session::flush();
        return redirect('admin/login');
    }

    public function teacherRegister(){
        if (!session()->has('cid')) {
            return redirect('admin/login');
        }
        $id = session()->get('id');
        return view('admin.register');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $teacher = Teacher::where('tid', $data["tid"])->first();
        if ($teacher) {
            return redirect()->back()->with('message', '既に登録済みです。')->with('success', false);
        } else {
            $company = new Teacher();
            $company->name = $data["name"];
            $company->tid = strtolower($data["tid"]);
            $company->tpass = strtolower($data["password"]);
            $company->save();
        }
        return redirect()->back()->with('message', '会社の登録完了しました。')->with('success', true);
    }

    public function getAllTeacher()
    {
        if (!session()->has('cid')) {
            return redirect('admin/login');
        }
        $id = session()->get('id');
        $teacher = Teacher::orderBy('id')->get();

        return view('admin.teacher_list', compact('teacher'));
        /* return response()->json(array(
            'success' => true,
            'data'   => $company
        ));  */
    }
    public function deleteTeacherById($id)
    {
        $company = Teacher::find($id);
        $company->delete();
        return redirect()->back()->with('message', '会社の削除完了しました。')->with('success', true);
    }
}
