<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function actionLogin(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // jika user menginput email dan passwordnya benar
        if(Auth::attempt($validate)){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        Alert::error('Gagal Masuk', 'Kredensial Tidak Valid');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to('/');
    }

    // public function redirect()
    // {
    //     return Socialite::driver('google')->redirect();
    // }

    // public function callbackGoogle(){
    //     try{
    //         $google_user = Socialite::driver('google')->user();
    //         $user = User::where('google_id', $google_user->getId())->first();

    //         if (empty($user)) {
    //             $new_user = User::create([
    //                 'name' => $google_user->getName(),
    //                 'email' => $google_user->getEmail(),
    //                 'google_id' => $google_user->getId(),
    //                 'role_id' => 1,
    //             ]);
    //             Auth::login($new_user);
    //             return redirect()->intended('dashboard');
    //         } else{
    //             Auth::login($user);
    //             return redirect()->intended('dashboard');
    //         }
    //     } catch (\Throwable $th) {
    //         dd("Sesuatu ada yang salah!" . $th->getMessage());
    //     }
    // }
}
