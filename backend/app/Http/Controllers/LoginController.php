<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function submit()
    {
        //validate phone number
        $request-validate([
            'phone' => 'required|numeric|min:10'
        ]);

        //find or create a user model
        $user = User::firstOrCreate([
            'phone' => $request->phone

        ]);

        if (!$user) {
            return response()->json(['message' => 'could not process a user with that phone number.'], 401);
        }

        //send the user a one time use code

        //return back a response
        
    }
}
