<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\OfficeHour;
use App\Models\TimeSchedule;
use Illuminate\Http\Request;
use App\Models\TAInformations;
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
            'photo' => ['nullable', 'file'],
            'contact' => ['nullable']
        ]);

        if ($validator->fails()) {
            // Notify the user of validation errors
            return redirect()->route('backend.ta-information.create')
                ->withInput()
                ->withErrors($validator);
        }

        $photo = null;

        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $photo = '/storage/'.$path;
        }

        // Create a new TAInformations instance and save it to the database
        $taInfo = new TAInformations();
        $taInfo->first_name = $request->input('first_name');
        $taInfo->last_name = $request->input('last_name');
        $taInfo->email = $request->input('email');
        $taInfo->phone_no = $request->input('phone');
        $taInfo->designations = $request->input('designation');
        $taInfo->dob = $request->input('dob');
        $taInfo->contact = $request->input('contact');
        $taInfo->gender = $request->input('gender');
        $taInfo->photo = $photo;
        $taInfo->save();

        flash()->addSuccess('TA Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.ta-information.create');
    }

    public function edit (Request $request, $id)
    {

        $data = TAInformations::where('uuid', $id)->first();

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
            'photo' => ['nullable', 'file'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('backend.ta-information.create')
                ->withInput()
                ->withErrors($validator);
        }

        // Find the existing TAInformation record by its ID
        $taInfo = TAInformations::where('uuid', $id)->first();

        if (!$taInfo) {
            flash()->addError('TA Not Found');
        }

        // Update the fields with the new data
        $taInfo->first_name = $request->input('first_name');
        $taInfo->last_name = $request->input('last_name');
        $taInfo->email = $request->input('email');
        $taInfo->phone_no = $request->input('phone');
        $taInfo->designations = $request->input('designation');
        $taInfo->dob = $request->input('dob');
        $taInfo->gender = $request->input('gender');
        $taInfo->contact = $request->input('contact');


        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $photo = '/storage/'.$path;
            $taInfo->photo = $photo;
        }
        $taInfo->save(); // Save the updated data

        // Redirect or respond with a success message
        flash()->addSuccess('TA Updated Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.ta-information');
    }


    public function view(Request $request, $id)
    {
        $data = TAInformations::where('uuid', $id)->first();
        $day = Day::all();
        return view('backend.ta-information.view-profile', compact('data', 'day'));
    }


    // public function view()
    // {
    //     // $data = TAInformations::where('uuid', $id)->first();
    //     $data = TAInformations::with(['officeHours', 'officeHours.day', 'officeHours.day.timeSchedules'])->get();
    //     $day = Day::all();

    //     return response()->json($data);
    //     // return view('backend.ta-information.view-profile', compact('data', 'day'));
    // }


    public function officeHour(Request $request, $id)
    {
        $data = TAInformations::where('uuid', $id)->first();
        $day = Day::all();
        $time = TimeSchedule::all();

        return view('backend.ta-information.office-hour', compact('data', 'day', 'time'));
    }

    public function postOfficeHour(Request $request, $id)
    {

        $taInfo = TAInformations::where('uuid', $id)->first();
        if(!$taInfo){
            flash()->addError('TA Not Found');
        }

        $validator = Validator::make($request->all(), [
            'day' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'course_code' => ['nullable'],
            'room_no' => ['nullable'],
            'office_hour' => ['nullable'],
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
        $data->persons_uuid = $id;
        $data->day_uuid = $request->input('day');
        $data->start_time = $request->input('start_time');
        $data->end_time = $request->input('end_time');
        $data->subject_code = $request->input('course_code');
        $data->room_no = $request->input('room_no');
        $data->office_hour = $request->input('office_hour');
        $data->idle = $request->input('idle');
        $data->save();

        flash()->addSuccess('Office Hour Added Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.ta-information.view', ['id' => $id]);
    }



}
