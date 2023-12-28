<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacultyInformation;

class FrontendFacultyController extends Controller
{
    //
    function index(){
        $data = \App\Models\FacultyInformation::orderBy('created_at', 'desc')
                ->paginate(10);
        return view('frontend.faculty.index', compact('data'));
    }


    function view(Request $request, $id){
        $data = FacultyInformation::with([
            'personOfficeHour',
            'personOfficeHour.day',
            'personOfficeHour.day.facultyOfficeHour' => function ($query) use ($id) {
                $query->where('faculty_offie_hour_lab_uuid', $id);
            }
        ])
        ->where('faculty_informations_uuid', $id)
        ->first();
    
        if(!$data){
            flash()->addError('Faculty not found');
            return to_route('faculty');
        }
        return view('frontend.faculty.view', [
            'data' => $data->toJson(JSON_PRETTY_PRINT)
        ]);
    }
}
