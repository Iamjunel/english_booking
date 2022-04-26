<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BookedLog;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Mail;
class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder email for student and teacher 1hr before the class.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //return 0;

        //get all the teacher that has a lesson 1 hour before.
        $teacher = Teacher::all();
        foreach ($teacher as $s) {
            $ldate = date('Y-m-d H:i:s');
            $curr = date('Y-m-d');
            $booked = BookedLog::where('teacher_id', $s->id)->where('date', $curr)->get();
            if (!empty($booked)) {
                foreach ($booked as $b) {
                    $hour_time = date("H", strtotime("$b->time"));
                    $current_hour_time = date("H", strtotime("$ldate"));
                    $hour_gap = $hour_time - $current_hour_time;
                    echo $hour_gap;
                    if ($hour_gap == 1) {
                        $ts   = strtotime($b->date);
                        $time = date('Y/m/d (D)', $ts) . "" . date('H:i', strtotime($b->time)) . '~' . date('H:i', strtotime($b->time) + 1500);
                        $teacher = Teacher::where('id', $b->teacher_id)->first();
                        $this->sendReminderStudentEmail($s->email, $time, $teacher->name, $teacher->zoom_link);
                        echo "Send Teacher Email to" . $s->name;
                    }
                }
            }
        }
        //echo "hello";
        //get all the student that has a lesson 1 hour before.
        //return 'hello';
        $student = Student::all();
        foreach ($student as $s) {
            $ldate = date('Y-m-d H:i:s');
            $curr = date('Y-m-d');
            $booked = BookedLog::where('student_id', $s->id)->where('date', $curr)->get();
            if (!empty($booked)) {
                foreach ($booked as $b) {
                    $hour_time = date("H", strtotime("$b->time"));
                    $current_hour_time = date("H", strtotime("$ldate"));
                    $hour_gap = $hour_time - $current_hour_time;
                    echo $hour_gap;
                    if ($hour_gap == 1) {
                        $ts   = strtotime($b->date);
                        $time = date('Y/m/d (D)', $ts) . "" . date('H:i', strtotime($b->time)) . '~' . date('H:i', strtotime($b->time) + 1500);
                        $teacher = Teacher::where('id',$b->teacher_id)->first();
                        $this->sendReminderStudentEmail($s->name,$s->email, $time, $teacher->name, $teacher->zoom_link);
                        echo "Send Student Email to".$s->name;
                    }
                }
            }
        }
    }
    //send email reminder to student and to teacher.
    public function sendReminderStudentEmail($s_name,$email, $time, $teacher_name, $zoom = "")
    {
        $check_email = $this->validate_email($email);
        if ($check_email) {
            $to = $email;
            $message = "Booking Lesson Details.";
            $details = [
                'body' =>  $message,
                'subject' => 'Think English Learning Center',
                'teacher_name' => $teacher_name,
                'time' => $time,
                'zoom'   => $zoom,
                'user'   => 'student',
                'student_name' => $s_name
            ];
            Mail::to($to)->send(new \App\Mail\SendReminderMail($details));
            //return back()->with('success_mail', 'Eメールが送信されました。');
        }
    }
    public function sendReminderTeacherEmail($email, $time, $teacher_name, $zoom = "")
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
                'zoom'   => $zoom,
                'user'   => 'teacher'
            ];
            Mail::to($to)->send(new \App\Mail\SendReminderMail($details));
            //return back()->with('success_mail', 'Eメールが送信されました。');
        }
    }
    public function validate_email($email)
    {
        return (preg_match("/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/", $email) || !preg_match("/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $email)) ? false : true;
    }
}
