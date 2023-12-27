<?php

namespace App\Http\Controllers;

use App\Models\MaketPlace;
use Illuminate\Http\Request;

class FrontendProfileController extends Controller
{
    //
    function index(Request $request, $id) {
        $post = \App\Models\Post::with(['users'])
                ->where('created_by', $id)
                ->orderBy('created_at', 'desc');
        $marketplace = MaketPlace::with(['users', 'category'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
             
        return view('frontend.profile.profile', [
            'post' => $post,
            'marketplace'  => $marketplace
        ]);
    }
}
