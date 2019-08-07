<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class SessionsController extends Controller
{
    public function create(){
    	return view('sessions.create');
    }

    public function store(Request $request){
    	$yz = $this->validate($request, [
    		'email' => 'required|email|max:255',
    		'password' => 'required'
    	]);

    	if (Auth::attempt($yz)) {
    		session()->flash('success', '登录成功，欢迎回来');
    		return redirect()->route('users.show', [Auth::user()]);
    	}else{
    		session()->flash('danger', '您输入的邮箱密码不匹配');
    		return redirect()->back()->withInput();
    	}
    }

    public function destory(){
        Auth::logout();
        session()->flash('success', '您已成功注销登录');
        return redirect('login');
    }
}
