<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TAInformations;

class FrontendTAController extends Controller
{
    //
    function index() {
        $data = \App\Models\TAInformations::orderBy('created_at', 'desc')
                ->paginate(10);
        return view('frontend.ta-info.index', compact('data'));
    }

    function view(Request $request, $id)  {
        $data = TAInformations::with([
            'personOfficeHour',
            'personOfficeHour.day',
            'personOfficeHour.day.officeHour'=> function ($query) use ($id) {
                $query->where('office_hours_persons_uuid', $id);
            }
        ])
        ->where('ta_informations_uuid', $id)
        ->first();
    
        // dd($data->toJson(JSON_PRETTY_PRINT));

        return view('frontend.ta-info.view', [
            'data' => $data->toJson(JSON_PRETTY_PRINT)
        ]);
    }
}
