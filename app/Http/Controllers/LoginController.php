<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use Illuminate\Support\Facades\Session;


class LoginController
{
    public function showFormLogin()
    {
        $cart = Session::get('cart');
        if (session('link')) {
            $myPath     = session('link');
            $loginPath  = url('/login');
            $previous   = url()->previous();

            if ($previous = $loginPath) {
                session(['link' => $myPath]);
            }
            else{
                session(['link' => $previous]);
            }
        }
        else{
            session(['link' => url()->previous()]);
        }
        return view('shop.login',compact('cart'));
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $data = [
            'email' => $email,
            'password' => $password
        ];
        if (Auth::attempt($data)) {
            return redirect(session('link'));
        }
        return back();
    }
    public function loginToReview(Request $request, $id){
        $email = $request->email;
        $password = $request->password;

        $data = [
            'email' => $email,
            'password' => $password
        ];
        if (Auth::attempt($data)) {
            return redirect()->route('shop.index',$id);
        }
        else return back();
    }
}
