<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendAlumniController extends Controller
{
    //
    function index() {
        $data = \App\Models\Alumni::orderBy('created_at', 'desc')
                ->paginate(10);

        return view('frontend.alumni.index', [
            'data' => $data
        ]);
    }
}
