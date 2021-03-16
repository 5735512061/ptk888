<?php

namespace App\Http\Controllers\AuthMember;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;

class RegisterController extends Controller
{
    public function ShowRegisterFormMember(){
        return view('authMember/register');
    }

    public function registerMember(Request $request) {
        $member = $request->all();
        $member['password'] = bcrypt($member['password']);
        $member = Member::create($member);
        return redirect()->intended(route('member.home'));
    }
}
