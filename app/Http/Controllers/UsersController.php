<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Mail;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth',[
        'except' => ['show','create','store','index','confirmEmail']
      ]);
      $this->middleware('guest',[
        'only' => ['create']
      ]);
    }

    public function index()
    {
        $users = User::paginate(14);
        return view('users.index', compact('users'));
    }

    public function create()
    {
      return view('users.create');
    }

    public function show(User $user)
    {
      $statuses = $user->statuses()->orderBy('created_at','desc')->paginate(14);
      return view('users.show',compact('user','statuses'));
    }

    public function store(Request $request)
    {
      $this->validate($request,[
        'name'=>'required|max:50',
        'email'=>'required|email|unique:users|max:255',
        'password'=>'required|confirmed|min:6'
      ]);

      $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
      ]);

      $this->sendEmailConfirmationTo($user);
      session()->flash('success','The verification email has been sent to your registered email address, please check it out!');
      return redirect('/');
    }

    public function edit(User $user)
    {
      $this->authorize('update',$user);
      return view('users.edit',compact('user'));
    }

    public function update(User $user,Request $request)
    {
      $this->authorize('update',$user);
      $this->validate($request,[
        'name' => 'required|max:50',
        'password' => 'required|confirmed|min:6',
      ]);

      $user->update([
        'name' => $request->name,
        'password' => bcrypt($request->password)
      ]);

      session()->flush('success','Successfully updated!');
      return redirect()->route('users.show',$user->id);
    }

    public function destroy(User $user)
    {
      $this->authorize('destroy',$user);
      $user->delete();
      session()->flash('success','Successfully deleted!');
      return back();
    }

    public function confirmEmail($token)
    {
      $user = User::where('activation_token', $token)->firstOrFail();
      $user->activated = true;
      $user->activation_token = null;
      $user->save();

      Auth::login($user);
      session()->flash('success','Successful activation !');
      return redirect()->route('users.show',[$user]);
    }

    protected function sendEmailConfirmationTo($user)
    {
      $view = 'emails.confirm';
      $data = compact('user');
      $to = $user->email;
      $subject = "Registration is successful ! Please confirm your email address.";

      Mail::send($view, $data, function ($message) use ($to, $subject) {
          $message->to($to)->subject($subject);
      });
    }

    public function followings(User $user)
    {
      $users = $user->followings()->paginate(30);
      $title = $user->name.'关注的人';
      return view('users.show_follow',compact('users','title'));
    }

    public function followers(User $user)
    {
      $users = $user->followers()->paginate(30);
      $title = $user->name.'的粉丝';
      return view('users.show_follow',compact('users','title'));
    }
}
