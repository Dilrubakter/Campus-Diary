<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClubInformation;

class FrontendclubController extends Controller
{
    //

    function index() {
        $data = ClubInformation::orderBy('created_at', 'desc')
                ->paginate(10);
        return view('frontend.club.index', compact('data'));
    }

    public function view(Request $request, $id)
    {
        $data = ClubInformation::with('panelMembers')->where('club_information_uuid', $id)->first();
        return view('frontend.club.view', [
            'data' => $data->toJson(JSON_PRETTY_PRINT)
        ]);
    }
}
