<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\TimeSchedule;
use Illuminate\Http\Request;
use App\Models\FacultyInformation;
use Illuminate\Support\Facades\Validator;

class FacultyInformationController extends Controller
{
    //
    public function index() {
        $data = \App\Models\FacultyInformation::all();
        return view('backend.faculty-information.index', compact('data'));
    }

    public function create() {
        return view('backend.faculty-information.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'room_no' => ['required'],
            'faculty_type' => ['required'],
            'phone' => ['nullable'],
            'designation' => ['nullable'],
            'gender' => ['required'],
            'dob' => ['nullable'],
            'bio' => ['nullable'],
            'photo' => ['nullable'],
        ]);

        if ($validator->fails()) {
            // Notify the user of validation errors
            flash()->addError('There was an issue saving your information.');
            return redirect()->route('backend.faculty-information.create')
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
        $faculty = new \App\Models\FacultyInformation();
        $faculty->faculty_informations_first_name = $request->input('first_name');
        $faculty->faculty_informations_last_name = $request->input('last_name');
        $faculty->faculty_informations_email = $request->input('email');
        $faculty->faculty_informations_contact = $request->input('phone');
        $faculty->faculty_informations_designations = $request->input('designation');
        $faculty->faculty_informations_dob = $request->input('dob');
        $faculty->faculty_informations_gender = $request->input('gender');
        $faculty->faculty_informations_room = $request->input('room_no');
        $faculty->faculty_informations_faculty_type = $request->input('faculty_type');
        $faculty->faculty_informations_bio = $request->input('bio');
        $faculty->faculty_informations_photo = $photo;
        $faculty->save();

        flash()->addSuccess('Faculty Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.faculty-information.create');
    }

    public function edit(Request $request, $id) {
        $data = FacultyInformation::where('faculty_informations_uuid', $id)->first();
        return view('backend.faculty-information.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'room_no' => ['required'],
            'faculty_type' => ['required'],
            'phone' => ['nullable'],
            'designation' => ['nullable'],
            'gender' => ['required'],
            'dob' => ['nullable'],
            'bio' => ['nullable'],
            'photo' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('backend.faculty-information.edit', ['id' => $id])
                ->withInput()
                ->withErrors($validator);
        }

        // Find the existing TAInformation record by its ID
        $faculty = FacultyInformation::where('faculty_informations_uuid', $id)->first();

        if (!$faculty) {
            flash()->addError('Faculty Not Found');
            return redirect()->route('backend.faculty-information.edit', ['id' => $id]);
        }

        $faculty->faculty_informations_first_name = $request->input('first_name');
        $faculty->faculty_informations_last_name = $request->input('last_name');
        $faculty->faculty_informations_email = $request->input('email');
        $faculty->faculty_informations_contact = $request->input('phone');
        $faculty->faculty_informations_designations = $request->input('designation');
        $faculty->faculty_informations_dob = $request->input('dob');
        $faculty->faculty_informations_gender = $request->input('gender');
        $faculty->faculty_informations_room = $request->input('room_no');
        $faculty->faculty_informations_faculty_type = $request->input('faculty_type');
        $faculty->faculty_informations_bio = $request->input('bio');


        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $photo = '/storage/'.$path;
            $faculty->faculty_informations_photo = $photo;
        }
        $faculty->save(); // Save the updated data

        // Redirect or respond with a success message
        flash()->addSuccess('Faculty Updated Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.faculty-information');
    }

    public function view(Request $request, $id)
    {
        $data = FacultyInformation::with([
            'personOfficeHour',
            'personOfficeHour.day',
            'personOfficeHour.day.facultyOfficeHour'
        ])
        ->where('faculty_informations_uuid', $id)
        ->first();
    
        // dd($data->toJson(JSON_PRETTY_PRINT));

        return view('backend.faculty-information.view-profile', [
            'data' => $data->toJson(JSON_PRETTY_PRINT)
        ]);
    }

    public function officeHour(Request $request, $id)
    {
        $data = FacultyInformation::where('faculty_informations_uuid', $id)->first();
        $day = Day::all();
        $time = TimeSchedule::all();

        return view('backend.faculty-information.office-hour', compact('data', 'day', 'time'));
    }


    public function postOfficeHour(Request $request, $id)
    {
        $taInfo = FacultyInformation::where('faculty_informations_uuid', $id)->first();
        if(!$taInfo){
            flash()->addError('Lab Not Found');
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
            return redirect()->route('backend.lab-information.office-hour', ['id' => $id])
                ->withInput()
                ->withErrors($validator);
        }

        // Create a new TAInformations instance and save it to the database
        $data = new \App\Models\FAcultyOfficeHour();
        $hourData = new \App\Models\FacultyOfficeHourDay();
        $hourData->faculty_office_hour_day_faculty_uuid = $id;
        $hourData->faculty_office_hour_day_day_uuid = $request->input('day');
        $data->faculty_offie_hour_lab_uuid = $id;
        $data->faculty_offie_hour_day_uuid = $request->input('day');
        $data->faculty_offie_hour_start_time = $request->input('start_time');
        $data->faculty_offie_hour_end_time = $request->input('end_time');
        $data->faculty_offie_hour_subject_code = $request->input('course_code');
        $data->faculty_offie_hour_room_no = $request->input('room_no');
        $data->faculty_offie_hour_office_hour = $request->input('office_hour');
        $data->faculty_offie_hour_idle = $request->input('idle');

        $existingRecord = \App\Models\FacultyOfficeHourDay::where('faculty_office_hour_day_day_uuid', $request->input('day'))
        ->where('faculty_office_hour_day_faculty_uuid', $id)
        ->first();

        if (!$existingRecord) {
            $hourData->save();
        }
        $data->save();

        flash()->addSuccess('Office Hour Added Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.faculty-information.view', ['id' => $id]);
    }
}
