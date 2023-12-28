<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\MaketPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    function index() {

        $alumni = Alumni::take(3)->get();
        $posts = \App\Models\Post::take(3)->get(); 
        $marketplaces = MaketPlace::with(['users', 'category'])
        ->orderBy('created_at', 'desc')
        ->take(6)->get();
        $taInfo = \App\Models\TAInformations::take(3)->get();
        $faculty = \App\Models\FacultyInformation::take(3)->get();
        return view('frontend.index', compact('alumni', 'posts', 'marketplaces', 'taInfo', 'faculty'));
    }   

    public function logout()
    {
        Auth::logout();  // Logout the user
        return redirect('/login');  // Redirect to the login page or any other route you want
    }

}
