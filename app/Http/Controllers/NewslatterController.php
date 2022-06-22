<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PharIo\Manifest\Email;
use DB;

class NewslatterController extends Controller
{
    public function regsiterUser(Request $request) 
    {
        $email = $request['email'];

        $values = array(
            'email' => $email,
            'isSubscribe' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        );
        DB::table('newslatterusers')->insert($values);

        return view('welcome');
    }

    public function unsubscribe($userID)
    {
        DB::table('newslatterusers')
        ->where('id', $userID)
            ->update(['isSubscribe' => 0, 'updated_at' => date('Y-m-d H:i:s')]);
        // Query end

        return view('welcome');
    }
}
