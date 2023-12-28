<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabInformation;

class FrontendLabController extends Controller
{
    //

    function index() {
        $data = \App\Models\LabInformation::orderBy('created_at', 'desc')
                ->paginate(10);
        return view('frontend.lab.index', compact('data'));
    }

    public function view(Request $request, $id)
    {
        $data = LabInformation::with([
            'personOfficeHour',
            'personOfficeHour.day',
            'personOfficeHour.day.labOfficeHour' => function ($query) use ($id) {
                $query->where('lab_offie_hour_lab_uuid', $id);
            }
        ])
        ->where('lab_information_uuid', $id)
        ->first();

        return view('frontend.lab.view', [
            'data' => $data->toJson(JSON_PRETTY_PRINT)
        ]);
    }
}
