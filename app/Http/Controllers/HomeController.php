<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    function index() {

        $alumni = Alumni::take(3)->get();
        return view('frontend.index', compact('alumni'));
    }   

    public function logout()
    {
        Auth::logout();  // Logout the user
        return redirect('/login');  // Redirect to the login page or any other route you want
    }

}
