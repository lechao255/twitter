<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class SessionsController extends Controller
{
    public function __construct(){
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function create(){
        // 登录用户不允许再进入登录页
        // if (Auth::user()) {
        //     return redirect()->route('home');
        // }
    	return view('sessions.create');
    }

    public function store(Request $request){
    	$yz = $this->validate($request, [
    		'email' => 'required|email|max:255',
    		'password' => 'required'
    	]);

    	if (Auth::attempt($yz, $request->has('remember'))) {
            if (Auth::user()->activated) {
                session()->flash('success', '登录成功，欢迎回来');
                $fallback = route('users.show', Auth::user());

                // 可以重定向到用户前一地址页面，fallback为默认转向地址
                return redirect()->intended($fallback);
                //return redirect()->route('users.show', [Auth::user()]);
            }else{
                Auth::logout();
                session()->flash('warning', '您的账号还未激活，请查看邮箱');
                return redirect('/');
            }
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
