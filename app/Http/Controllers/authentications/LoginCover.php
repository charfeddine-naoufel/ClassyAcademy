<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginCover extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-login-cover', ['pageConfigs' => $pageConfigs]);
  }
  protected function login(Request $request)
    {
      $credentials = $request -> validate([
        'email' =>'required|email',
        'password' =>'required'
      ]);
      if (Auth::attempt($credentials))
      {
          $user = Auth::user();


          switch($user->role)
          {
            case 'admin':
              {return redirect()->route('admin-dash');break;}
              // return redirect('/admin');break;
            case 'student':
              {return redirect()->route('student-dash');break;}
            case 'teacher':
              {return redirect()->route('teacher-dash');break;}
            default:

              {Auth::logout();
              return redirect('/login')->with('error',"Erreur d'authentification");}


          }
      }
      else
        {
          return redirect('/login');
        }
      }
}
