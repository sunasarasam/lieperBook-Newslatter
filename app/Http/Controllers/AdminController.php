<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail as Mail;
use Illuminate\Support\HtmlString;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redis;
use Session;

class AdminController extends Controller
{
    public function index() 
    {
        $posts = DB::table('posts')->get();

        if (Session::has('email')) {
            return view('dashboard', ['posts' => $posts]);
        } else {
            return view('admin');
        }
    }

    public function adminLogin(Request $request)
    {
        if (Session::has('email')) {
            $posts = DB::table('posts')->get();
            
            return view('dashboard', ['posts' => $posts]);
        } else {
            $email = $request['email'];
            $pass = $request['password'];
            $password = hash('sha256', $pass);

            $getAdmin = DB::table('admin')
                ->select('email', 'password')
                ->where('email', '=', $email)
                ->first();
            // query end

            if ($getAdmin->password == $password) {
                $request->session()->put('email', $getAdmin->email);

                return redirect('/admin');
            } else {
                return view('admin');
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        return redirect('/admin');
    }

    public function post(Request $request)
    {
        $title = $request['title'];
        $desc = $request['desc'];

        $values = array(
            'title' => $title,
            'desc' => $desc,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        );
        DB::table('posts')->insert($values);

        $users = DB::table('newslatterusers')
            ->select('id', 'email')
            ->where('isSubscribe', '=', 1)
            ->get();
        // Query end

        $adminEmail = session('email');

        foreach ($users as $user) {
            $messageBody = $desc;

            $messageBody = new HtmlString('Title: ' . $title .' <br> Description: ' . $title . ' <br><br> To Unsubscribe <a href="' . url('/unsubscribe/' . $user->id) . '">lick Me</a>');
            $subjectMsg = 'newslatter Lieper Books';
            $recieverEmailID = $user->email;
            $this->mailFunction($recieverEmailID, $subjectMsg, $messageBody);
        }

        return redirect('admin');
    }

    public static function mailFunction($recieverEmailID, $subjectMsg, $message)
    {

        $data = array('body' => $message);
        $recieverEmailDetails = array($recieverEmailID);
        $senderDetails = array('Add Email Address Here' => 'Lieper');

        Mail::send('mail', $data, function ($message) use ($recieverEmailDetails, $senderDetails, $subjectMsg) {
            $message->from($senderDetails);
            $message->to($recieverEmailDetails)->subject($subjectMsg);
        });

        return;
    }
}
