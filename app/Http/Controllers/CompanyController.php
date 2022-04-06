<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Session;
class CompanyController extends Controller
{
    //
    
    
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
    
    public function update(Request $request, $id){
        var_dump($request);die;
    }


    
    

}
