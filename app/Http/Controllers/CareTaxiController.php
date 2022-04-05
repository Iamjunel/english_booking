<?php

namespace App\Http\Controllers;

use App\Models\BusinessHours;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyStatus;
use  App\Models\CompanyImages;
use stdClass;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class CareTaxiController extends Controller
{
    //

    public function login()
    {
        return view('care-taxi.login');
    }

    public function index()
    {
        if (!session()->has('cid')) {
            return redirect('care-taxi/login');
        } else {
            $cid = session()->get('cid');
            $check_cid = Company::Where('cid', $cid)->first();
            if (!$check_cid) {
                Session::flush();
                return redirect('care-taxi/login');
            }
        }
        $id = session()->get('id');
        return view('care-taxi.index',compact('id'));
    }
    public function availableSlot()
    {   
        if (!session()->has('cid')) {
                return redirect('care-taxi/login');
        }else{
            $cid = session()->get('cid');
            $check_cid = Company::Where('cid', $cid)->first();
            if (!$check_cid) {
                Session::flush();
                return redirect('care-taxi/login');
            }
        }
        return view('care-taxi.booking');
    }
    public function editDetailDate($id, $date)
    {
        if (session()->get('id') != $id) {
            Session::flush();
            return redirect('care-taxi/login');
        } else {
            $cid = session()->get('cid');
            $check_cid = Company::Where('cid', $cid)->first();
            if (!$check_cid) {
                Session::flush();
                return redirect('care-taxi/login');
            }
        }
        $company = Company::with('business_hours')->where('id', $id)->first();
        $previous_date =  date('Y-m-d', strtotime($date . ' -1 day'));
        $next_date = date('Y-m-d', strtotime($date . ' +1 day'));
        $bus_hours = $company->business_hours;
        $day = date('l', strtotime($date));
        $time = array();
        $time_start = null;
        $time_end = null;
        $has_no_schedule = false;
        if ($day == "Monday"
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
            $has_no_schedule =true;
        }
        //$time_start = "00:00";
        //$time_end = "23:30";
        
        $company_status = CompanyStatus::Where('company_id',$id)->where('date',$date)->get();
        
        if(empty($company_status)){
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
        }else{
           
           //default status
            $status = "circle";
            $comment = "";
            $curr_time = $date . ' ' . $time_start;
            foreach ($company_status as $company) {
                
                if ($company->time == date('h:ia', strtotime($curr_time))) {                   
                    $status = $company->status;
                    $comment = $company->comment;
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
                    
                    foreach($company_status as $company){
                        
                        if($company->time == date('h:ia', $added_time)){
                           // var_dump($company->status);
                            $status = $company->status;
                            $comment = $company->comment;
                            break;
                        }
                    }
                    array_push(
                        $time, [
                            'time' => date('h:ia', $added_time),
                            'status' => $status,
                            'comment' => $comment,
                        
                ]);
                } else {
                    foreach ($company_status as $company) {
                        if ($company->time == date('h:ia', $added_time)) {
                            $status = $company->status;
                            $comment = $company->comment;
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
        $dy  = date("w",strtotime($date));
        $dys = array("日", "月", "火", "水", "木", "金", "土");
        $dyj = $dys[$dy];
        $date_jp = date('Y年m月d日', strtotime($date));
        $date_jp = $date_jp.'('.$dyj.')';
        $this_time_str = strtotime(date("H:i"));
        /* return response()->json(array(
            'success' => true,
            'data'   => $company_status,
            'day'    => $time,
        ));  */
        return view('care-taxi.update_status', compact('this_time_str','time', 'date', 'company','id','not_current','previous_date','next_date','date_jp', 'has_no_schedule'));
    }
    public function edit($id){
        if (session()->get('id') != $id) {
            Session::flush();
            return redirect('care-taxi/login');
        }
        $company = Company::with('business_hours')->where('id',$id)->first();
        if(!isset($company->business_hours)){
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
        }else{
            $bh = $company->business_hours;
            
        }
        $company_images = CompanyImages::where('company_id',$id)->get();
        return view('care-taxi.company_info',compact('company','bh','company_images'));
    }
    public function update(Request $request){
        $data = $request->all();
        $company = Company::where('id', $data["id"])->first();
        $company->name = $data["name"];
        $company->alias = $data["alias"];
        $company->in_charge = $data["in_charge"];
        $company->address = $data["address"];
        $company->notes = $data["notes"];
        $company->cid = $data["cid"];
        $company->cpass = $data["cpass"];
        $company->email = $data["email"];
        $company->fax = $data["fax"];
        $company->phone = $data["phone"];
        $company->call_start = $data["call_start"];
        $company->call_end = $data["call_end"];
        $company->nursing_status = $data["nursing_status"];
        $company->helper_status = $data["helper_status"];
        $company->oxygen_status = $data["oxygen_status"];
        $company->ventilator_status = $data["ventilator_status"];
        $company->hp = $data["hp"];

        $company->wheelchair_status = $data["wheelchair_status"];
        $company->re_wheelchair_status = $data["re_wheelchair_status"];
        $company->stretcher_status = $data["stretcher_status"];
        $company->oximeter_status = $data["oximeter_status"];
        $company->sputum_status = $data["sputum_status"];
        $company->slope_status = $data["slope_status"];
        $company->basic_care_status = $data["basic_care_status"];
        $company->attendant_status = $data["attendant_status"];

        $company->dob = $data["dob"];
        $company->qualification = $data["qualification"];
        $company->profile = $data["profile"];
        $company->phone2 = $data["phone2"];
        $company->accreditation = $data["accreditation"];
        
        $company->update();
        $bus_hours = BusinessHours::where('company_id', $data["id"])->first();
        if(!empty($bus_hours)){
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
        }else{
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
            $bus_hours->company_id =  $data["id"];
            $bus_hours->save();   
        }
        if($request->file('file')){
        $fileNames = array();
        foreach ($request->file('file') as $image) {
            $imageName = $image->getClientOriginalName();
            $image->move(public_path() . '/images/', $imageName);

            CompanyImages::create([
                'url' => $imageName,
                'company_id' => $request->id

            ]);
        }
        }

        //$images = json_encode($fileNames);

        // Store $images image in DATABASE from HERE 

        $current_images = CompanyImages::where('company_id', $request->id)->get();
        foreach ($current_images as $value) {
            $fileNames[] = $value->url;
        }
        return redirect()->back()->with('message', '更新完了しました。');
    }

    public function checkLogin(Request $request)
    {

        $request->validate([
            'cid' => ['required'],
            'cpass' => ['required']
        ]);

        $user = Company::where('cid', $request->cid)->where('cpass', $request->cpass)->first();
        if (!empty($user)) {
                $request->session()->put('cid', $user->cid);
                $request->session()->put('name', $user->name);
                $request->session()->put('id', $user->id);
                $request->session()->save();
                return redirect('/care-taxi');
        } else {
               return redirect('care-taxi/login')->with('message', 'ID又はパスワードの入力に誤りがあります。');
        }
        
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $company = Company::where('cid', $data["cid"])->first();
        if ($company) {
            return redirect()->back()->with('message', '既に登録済みです。');
        } else {
            $company = new Company();
            $company->name = $data["name"];
            $company->cid = $data["cid"];
            $company->cpass = $data["password"];
            $company->save();

        }
        
        return redirect()->back()->with('message', '会社の登録完了しました。');
        
    }
    public function statusUpdate(Request $request)
    {
        if (!session()->has('cid')) {
            Session::flush();
            return redirect('care-taxi/login');
        } 
        $data=array();
        $current_date = $request->get('date');
        $company_id =  $request->get('id');
        
        foreach ($request->all() as $key => $value) {
            if($key !="_token" && $key != 'date' && $key != 'id'){
                $time = explode('-', $key);
              if(count($time)>1){
                    $status = 'status-' . $time[1];
                    $comment = 'comment-' . $time[1];
                    if ($key == $status) {
                        $company_status = CompanyStatus::Where('company_id', $company_id)->where('date', $current_date)->where('time', $time[1])->first();
                        if (!empty($company_status->id)) {
                            //$com_status = CompanyStatus::Where('company_id', $company_id)->delete();
                            
                            DB::table('company_status')->Where('company_id', $company_id)->delete();
                            /* $company_status->time =  $time[1];
                            $company_status->status = $request->get($status);
                            $company_status->comment = $request->get($comment);
                            $company_status->update(); */
                            $company_status = new CompanyStatus();
                            $company_status->time = date("h:ia", strtotime($time[1]));
                            $company_status->status = $request->get($status);
                            $company_status->comment = $request->get($comment);
                            $company_status->company_id = $company_id;
                            $company_status->date = $current_date;
                            $company_status->save();
                        } else {
                            $company_status = new CompanyStatus();
                            $company_status->time = date("h:ia", strtotime($time[1]));
                            $company_status->status = $request->get($status);
                            $company_status->comment = $request->get($comment);
                            $company_status->company_id = $company_id;
                            $company_status->date = $current_date;
                            $company_status->save();
                        }
                     }    
                }
             
            }
        }
        //die;
        return redirect()->back()->with('message', '更新完了しました。');
        
    }


    public function logout()
    {
        Session::flush();
        return redirect('care-taxi/login');
    }
    public function slotDetailDate($id, $date)
    {
        if (session()->get('id') != $id) {
            Session::flush();
            return redirect('care-taxi/login');
        }
        if (!session()->has('cid')) {
            return redirect('care-taxi/login');
        } else {
            $cid = session()->get('cid');
            $check_cid = Company::Where('cid', $cid)->first();
            if (!$check_cid) {
                Session::flush();
                return redirect('care-taxi/login');
            }
        }
        $time = array();
        $company = Company::with('business_hours')->where('id', $id)->first();
        $previous_date =  date('Y-m-d', strtotime($date . ' -1 day'));
        $next_date = date('Y-m-d', strtotime($date . ' +1 day'));
       
        if($company->business_hours){
            $bus_hours = $company->business_hours;
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
                $has_no_schedule= 1;
                $time_start = "00:00";
                $time_end = "00:00";
            }

            $company_status = CompanyStatus::Where('company_id', $id)->where('date', $date)->get();
            
            if (count($company_status) == 0) {
                
                $status = "circle";
                $comment = "";
                $curr_time = $date . ' ' . $time_start;
                array_push($time, [
                    'time' => date('h:ia', strtotime($curr_time)),
                    'status' => $status,
                    'comment' => $comment,
                ]);
                $current = strtotime($curr_time);
                $start = strtotime($date . ' ' .$time_start);
                $end = strtotime($date . ' ' .$time_end);

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
                foreach ($company_status as $company) {

                    if ($company->time == date('h:ia', strtotime($curr_time))) {
                        $status = $company->status;
                        $comment = $company->comment;
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

                        foreach ($company_status as $company) {

                            if ($company->time == date('h:ia', $added_time)) {
                                $status = $company->status;
                                $comment = $company->comment;
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
                        foreach ($company_status as $company) {
                            if ($company->time == date('h:ia', $added_time)) {
                                $status = $company->status;
                                $comment = $company->comment;
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
        $not_current =true;
        if($date == date('Y-m-d')){
            $not_current=false;
        }

        $dy  = date("w", strtotime($date));
        $dys = array("日", "月", "火", "水", "木", "金", "土");
        $dyj = $dys[$dy];
        $date_jp = date('Y年m月d日', strtotime($date));
        $date_jp = $date_jp . '(' . $dyj . ')';
        $this_time_str = strtotime(date("H:i"));

        return view('care-taxi.show_status', compact('this_time_str','time', 'date', 'company', 'id','previous_date','next_date','not_current','date_jp','has_no_schedule'));
    }
    
}
