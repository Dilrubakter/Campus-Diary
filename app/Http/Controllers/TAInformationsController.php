<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\OfficeHour;
use App\Models\TimeSchedule;
use Illuminate\Http\Request;
use App\Models\TAInformations;
use App\Models\PersonOfficeHourDay;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TAInformationsController extends Controller
{
    //

    public function index() {
        $data = TAInformations::all();

        return view('backend.ta-information.index', compact('data'));
    }

    public function create() {
        return view('backend.ta-information.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'phone' => ['nullable'],
            'designation' => ['required'],
            'dob' => ['nullable'],
            'gender' => ['required'],
            'photo' => ['nullable'],
            'contact' => ['nullable']
        ]);

        if ($validator->fails()) {
            // Notify the user of validation errors
            return redirect()->route('backend.ta-information.create')
                ->withInput()
                ->withErrors($validator);
        }

        $photo = '';

        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $photo = '/storage/'.$path;
        }

        // Create a new TAInformations instance and save it to the database
        $taInfo = new TAInformations();
        $taInfo->ta_informations_first_name = $request->input('first_name');
        $taInfo->ta_informations_last_name = $request->input('last_name');
        $taInfo->ta_informations_semail = $request->input('email');
        $taInfo->ta_informations_phone_no = $request->input('phone');
        $taInfo->ta_informations_designations = $request->input('designation');
        $taInfo->ta_informations_dob = $request->input('dob');
        $taInfo->ta_informations_contact = $request->input('contact');
        $taInfo->ta_informations_gender = $request->input('gender');
        $taInfo->ta_informations_photo = $photo;
        $taInfo->save();

        flash()->addSuccess('TA Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.ta-information.create');
    }

    public function edit (Request $request, $id)
    {

        $data = TAInformations::where('ta_informations_uuid', $id)->first();

        return view('backend.ta-information.edit', compact('data'));

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'phone' => ['nullable'],
            'designation' => ['required'],
            'dob' => ['nullable'],
            'contact' => ['nullable'],
            'gender' => ['required'],
            'photo' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('backend.ta-information.create')
                ->withInput()
                ->withErrors($validator);
        }

        // Find the existing TAInformation record by its ID
        $taInfo = TAInformations::where('ta_informations_uuid', $id)->first();

        if (!$taInfo) {
            flash()->addError('TA Not Found');
        }

        // Update the fields with the new data
        $taInfo->ta_informations_first_name = $request->input('first_name');
        $taInfo->ta_informations_last_name = $request->input('last_name');
        $taInfo->ta_informations_semail = $request->input('email');
        $taInfo->ta_informations_phone_no = $request->input('phone');
        $taInfo->ta_informations_designations = $request->input('designation');
        $taInfo->ta_informations_dob = $request->input('dob');
        $taInfo->ta_informations_gender = $request->input('gender');
        $taInfo->ta_informations_contact = $request->input('contact');


        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $photo = '/storage/'.$path;
            $taInfo->ta_informations_photo = $photo;
        }
        $taInfo->save(); // Save the updated data

        // Redirect or respond with a success message
        flash()->addSuccess('TA Updated Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.ta-information');
    }


    public function view(Request $request, $id)
    {
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

        return view('backend.ta-information.view-profile', [
            'data' => $data->toJson(JSON_PRETTY_PRINT)
        ]);
    }

    public function officeHour(Request $request, $id)
    {
        $data = TAInformations::where('ta_informations_uuid', $id)->first();
        $day = Day::all();
        $time = TimeSchedule::all();

        return view('backend.ta-information.office-hour', compact('data', 'day', 'time'));
    }

    public function postOfficeHour(Request $request, $id)
    {

        $taInfo = TAInformations::where('ta_informations_uuid', $id)->first();
        if(!$taInfo){
            flash()->addError('TA Not Found');
        }

        $validator = Validator::make($request->all(), [
            'day' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'course_code' => ['nullable', 'required_without_all:office_hour,room_no', 'required_with:room_no'],
            'room_no' => ['nullable', 'required_without_all:office_hour,course_code', 'required_with:course_code'],
            'office_hour' => ['nullable', 'required_without_all:course_code,room_no'],
            'idle' => ['nullable']
        ]);
        

        if ($validator->fails()) {
            // Notify the user of validation errors
            return redirect()->route('backend.ta-information.office-hour', ['id' => $id])
                ->withInput()
                ->withErrors($validator);
        }

        // Create a new TAInformations instance and save it to the database
        $data = new OfficeHour();
        $hourData = new PersonOfficeHourDay();
        $hourData->person_office_hour_day_person_uuid = $id;
        $hourData->person_office_hour_day_day_uuid = $request->input('day');
        $data->office_hours_persons_uuid = $id;
        $data->office_hours_day_uuid = $request->input('day');
        $data->office_hours_start_time = $request->input('start_time');
        $data->office_hours_end_time = $request->input('end_time');
        $data->office_hours_subject_code = $request->input('course_code');
        $data->office_hours_room_no = $request->input('room_no');
        $data->office_hours_office_hour = $request->input('office_hour');
        $data->office_hours_idle = $request->input('idle');

        $existingRecord = PersonOfficeHourDay::where('person_office_hour_day_day_uuid', $request->input('day'))
        ->where('person_office_hour_day_person_uuid', $id)
        ->first();

        if (!$existingRecord) {
            $hourData->save();
        }
        $data->save();

        flash()->addSuccess('Office Hour Added Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.ta-information.view', ['id' => $id]);
    }

    public function delete($id) {
        TAInformations::where('ta_informations_uuid', $id)->delete();
        flash()->addSuccess('Ta Information Deleted Successfully');
        return back();
    }


    public function checkResponse()
    {
        $id = '9add31e6-6831-437c-82a7-6842f6ad775c';
    
        $data = TAInformations::with([
            'personOfficeHour',
            'personOfficeHour.day',
            'personOfficeHour.day.officeHour'
        ])
            ->where('ta_informations_uuid', $id)
            ->first();

        return response()->json($data, 200);
    
        // $personOfficeHour = $data['personOfficeHour'];
        // // return view('backend.ta-information.view-profile', [
        // //     'data' => $data
        // // ]);
        // return view('backend.ta-information.view-profile', compact('data', 'personOfficeHour'));

        return response()->json(['message' => 'Hello']);


    }
    


}
