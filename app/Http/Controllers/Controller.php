<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function encode($val, $base = 62,  $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $val = $val *100000;
        // can't handle numbers larger than 2^31-1 = 2147483647
        $str = '';
        do {
            $i = $val % $base;
            $str = $chars[$i] . $str;
            $val = ($val - $i) / $base;
        } while ($val > 0);
        return $str;
    }

    public function decode($str, $base = 62, $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $len = strlen($str);
        $val = 0;
        $arr = array_flip(str_split($chars));
        for ($i = 0; $i < $len; ++$i) {
            $val += $arr[$str[$i]] * pow($base, $len - $i - 1);
        }
        return $val / 100000;
    }
    public function sendEmail()
    {

        
            $to = "junelidano@gmail.com";
            $message = "Testing";
            $details = [
                'title' => 'Mail from English Booking.',
                'body' =>  $message,
                'subject' => 'StateNote Web Support'
            ];
            Mail::to($to)->send(new \App\Mail\SendMail($details));
            return back()->with('success_mail', 'Eメールが送信されました。');
       
    }
    public function sendStudentEmail($email,$time,$teacher_name,$zoom="")
    {
        $check_email = $this->validate_email($email);
        if($check_email){
            $to = $email;
            $message = "Booking Lesson Details." ;
            $details = [
                'body' =>  $message,
                'subject' => 'Think English Learning Center',
                'teacher_name' => $teacher_name,
                'time' => $time,
                'zoom'   => $zoom
            ];
            Mail::to($to)->send(new \App\Mail\SendMail($details));
            //return back()->with('success_mail', 'Eメールが送信されました。');
        }
        
    }
    public function sendTeacherEmail($email, $time, $teacher_name, $zoom = "")
    {
        $check_email = $this->validate_email($email);
        if ($check_email) {
            $to = $email;
            $message = "Teacher Booking Lesson Details.";
            $details = [
                'body' =>  $message,
                'subject' => 'Think English Learning Center',
                'teacher_name' => $teacher_name,
                'time' => $time,
                'zoom'   => $zoom
            ];
            Mail::to($to)->send(new \App\Mail\SendMail($details));
            //return back()->with('success_mail', 'Eメールが送信されました。');
        }
    }
    public function sendAdminEmail($email, $time, $teacher_name, $zoom = "")
    {
        $check_email = $this->validate_email($email);
        if ($check_email) {
            $to = "englishbooking01@gmail.com";
            $message = "Admin Booking Lesson Details.";
            $details = [
                'body' =>  $message,
                'subject' => 'Think English Learning Center',
                'teacher_name' => $teacher_name,
                'time' => $time,
                'zoom'   => $zoom
            ];
            Mail::to($to)->send(new \App\Mail\SendMail($details));
            //return back()->with('success_mail', 'Eメールが送信されました。');
        }
    }


    public function validate_email($email)
    {
        return (preg_match("/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/", $email) || !preg_match("/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $email)) ? false : true;
    }
}
