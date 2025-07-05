<?php

namespace App\Http\Controllers;
use Hash;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Str;
use App\Http\Requests\ResetPassword;
use App\Mail\ForgotPasswordMail;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->is_role);
        }
        return view('auth.login');
    }

    
    public function login_post(Request $request)
{
    if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)){
        $role = Auth::user()->is_role;

        if ($role == 1) {
            return redirect('admin/dashboard');
        } elseif ($role == 2) {
            return redirect('manager/dashboard');
        } else {
            Auth::logout();
            return redirect()->back()->with('error', 'Invalid Role');
        }
    } else {
        return redirect()->back()->with('error', 'Invalid credentials');
    }
}

    private function redirectByRole($role)
    {
        switch ($role) {
            case 1:
                return redirect('admin/dashboard');
            case 2:
                return redirect('manager/dashboard');
            default:
                Auth::logout();
                return redirect()->back()->with('error', 'Role tidak dikenali.');
        }
    }

    public function forgot()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->is_role);
        }
        return view('auth.forgot');
    }


    public function forgot_post(Request $request){
        #dd($request->all());

        $count = User::where('email', '=', $request->email)->count();
        if($count > 0)
        {
            $user = User::where('email', '=', $request->email)->first();
            $user->remember_token = Str::random(50);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', 'Password has been reset. Please check your SPAM or junk mail folder.');
        }else{
            return redirect()->back()->withInput()->with('error', 'Email not found in the system.');
        }
    }
    
    public function getReset($token)
    {
        #dd($token);
        if(Auth::check()){
            return redirect('admin/dashboard');
        }

        $user = User::where('remember_token', '=', $token);
        if($user->count() == 0){
            abort(403);
        }
        $user = $user->first();
        $data['token'] = $token;
        return view('auth.reset', $data);
    }

    public function postReset($token, ResetPassword $request)
    {
        $user = User::where('remember_token', '=', $token);
        if($user->count() == 0){
            abort(403);
        }

        $user = $user->first();
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(50);
        $user->save();

        return redirect('/')->with('success', 'Password has been reset');
    }


    public function logout(){
        Auth::logout();
        return redirect(url('/'));
    }
}
