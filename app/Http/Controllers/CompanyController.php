<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Session;
class CompanyController extends Controller
{
    //
    public function login(){
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
    public function companyRegister()
    {
        if (!session()->has('cid')) {
            return redirect('admin/login');
        }
        $id = session()->get('id');
        return view('admin.register');
    }
    public function getAllCompany(){
        if (!session()->has('cid')) {
            return redirect('admin/login');
        }
        $id = session()->get('id');
        $company = Company::orderBy('id')->get();
        
        return view('admin.company_list',compact('company'));
        /* return response()->json(array(
            'success' => true,
            'data'   => $company
        ));  */
    }
    public function getCompanyById($id)
    {
        if (!session()->has('cid')) {
            return redirect('admin/login');
        }
        
        $company = Company::where('id',$id)->first();
        return response()->json(array(
            'success' => true,
            'data'   => $company
        ));
    }
    public function deleteCompanyById($id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect()->back()->with('message', '会社の削除完了しました。');
        /* return response()->json(array(
            'success' => true,
            'data'   => $company
        ));  */
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $company = Company::where('cid', $data["cid"])->first();
        if ($company) {
            return redirect()->back()->with('message', '既に登録済みです。');
        } else {
            $company = new Company();
            $company->alias = $data["name"];
            $company->name = "";
            $company->cid = strtolower($data["cid"]);
            $company->cpass = strtolower($data["password"]);
            $company->save();

            /* if ($request->loginId) {
                $checkuser = User::where('name', $request->groupCode)->first();
                if ($checkuser) {
                    $checkuser->delete();
                }
                $user = new User();
                $user->name = $request->loginId;
                $user->email = $request->loginId;
                $user->access_number = 1;
                $user->password = Hash::make($request->password);
                $user->save();
            } */
        }
        return redirect()->back()->with('message', '会社の登録完了しました。');
        /* return response()->json(array(
            'success' => true,
            'message' => 'Company added successfully.',
        )); */
    }
    public function update(Request $request, $id){
        var_dump($request);die;
    }


    public function checkLogin(Request $request)
    { 
        
        $request->validate([
            'cid' => ['required'],
            'cpass' => ['required']
        ]);

        //$user = Company::where('cid', $request->cid)->where('cpass', $request->cpass)->first();
        if ($request->cid == "taxi111" && $request->cpass == "taxi111") {
            /* $request->session()->put('cid', $user->cid);
            $request->session()->put('name', $user->name);
            $request->session()->put('id', $user->id); */

            $request->session()->put('cid', 'taxi111');
            $request->session()->put('name', 'taxi111');
            $request->session()->put('id', 1);
            $request->session()->save();
            return redirect('/admin');
        } else {
            return redirect('admin/login')->with('message', 'ID又はパスワードの入力に誤りがあります。');
        }
    }
    public function logout()
    {
        Session::flush();
        return redirect('admin/login');
    }
    

}
