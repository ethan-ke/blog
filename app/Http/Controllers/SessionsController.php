<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class SessionsController extends Controller
{
    public function create()
    {
      return view('sessions.create');
    }

    public function store(Request $request)
    {
      $credentials = $this->validate($request,[
        'email'=>'required|email|max:255',
        'password'=>'required'
      ]);

      if (Auth::attempt($credentials)) {
        session()->flash('success','Welcome to back!');
        return redirect()->route('users.show',[Auth::user()]);
      } else {
        session()->flash('danger','Your password is incorrect');
        return redirect()->back()->withInput();
      }
    }

    public function destroy()
    {
      Auth::logout();
      session()->flash('success','Successful logout!');
      return redirect('login');
    }
}