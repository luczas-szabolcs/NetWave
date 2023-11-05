<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Session;

class BejelentkezoRendszer extends Controller
{

    public function index()
    {
        return view('auth.Bejelentkezes');
    }  
      

    public function registration()
    {
        return view('auth.Regisztracio');
    }
      

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Sikeres belépés');
        }
  
        return redirect("login")->withSuccess('Helytelen adatot adtál meg!');
    }
      

    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Sikeres bejelentkezés');
    }
    

    public function dashboard()
    {
        if(Auth::check()){
            return view('auth.Kezdolap');
        }
  
        return redirect("login")->withSuccess('Nincs hozzáférésed ehhez az oldalhoz!');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}


