<?php


namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Ban;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

//
class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function login(Request $request)
    {

       $credentials = $request->only('email', 'password');

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'banned' => 0])) {
            // Authentication passed...
            return redirect()->intended('home');
        } else {
                  if (Auth::attempt($credentials)) {
                       
                       $ban = Ban::where([
                                        ['user_banned', '=', Auth()->user()->id],
                                        ['expired', '=', 0],
                                            ])->firstOrFail();
                       if($ban->expire_on <= date("Y-m-d H:i:s")) {
                            $ban->expired = true;
                            $ban->save();

                            $user = User::find(Auth()->user()->id);
                            $user->banned = 0;
                            $user->save();

                            return redirect()->intended('home');
                       } 

                       Auth::logout();
                       return redirect()->intended('/login')->with('error', 'You are banned expire on: '.$ban->expire_on.'!');
                         
                    }
                         return redirect()->intended('/login')->with('error', 'No user with that credentials!');
        }
    }


    public function showLoginForm() {

        return view('auth.login');

    }

    public function logout() {
        Auth::logout();
        return redirect()->intended('/');
    }
}
