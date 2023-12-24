<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\OfficeHour;
use App\Models\TimeSchedule;
use Illuminate\Http\Request;
use App\Models\LabInformation;
use App\Models\LabOffieHour;
use App\Models\LabOffieHourDay;
use App\Models\PersonOfficeHourDay;
use Illuminate\Support\Facades\Validator;

class LabInformationController extends Controller
{
    //

    public function index() {
        $data = LabInformation::all();
        return view('backend.lab-information.index', compact('data'));
    }

    public function create() {
        return view('backend.lab-information.create', );
    }


    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'lab_name' => ['required'],
            'room_no' => ['required'],
            'photo' => ['nullable'],
        ]);

        if ($validator->fails()) {
            // Notify the user of validation errors
            return redirect()->route('backend.lab-info.create')
                ->withInput()
                ->withErrors($validator);
        }

        $photo = '';

        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $photo = '/storage/'.$path;
        }

        $labInfo = new LabInformation();
        $labInfo->lab_information_name = $request->input('lab_name');
        $labInfo->lab_information_room_no = $request->input('room_no');
        $labInfo->lab_information_photo = $photo;
        $labInfo->save();

        flash()->addSuccess('Lab Information Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.lab-information.create');
    }

    public function edit(Request $request, $id) {
        $data = LabInformation::where('lab_information_uuid', $id)->first();
        return view('backend.lab-information.edit', compact('data'));
    }

    public function view(Request $request, $id)
    {
        $data = LabInformation::with([
            'personOfficeHour',
            'personOfficeHour.day',
            'personOfficeHour.day.labOfficeHour'
        ])
        ->where('lab_information_uuid', $id)
        ->first();
    
        // dd($data->toJson(JSON_PRETTY_PRINT));

        return view('backend.lab-information.view-lab', [
            'data' => $data->toJson(JSON_PRETTY_PRINT)
        ]);
    }

    public function update(Request $request, $id)
    {
    $validator = Validator::make($request->all(), [
        'lab_name' => ['required'],
        'room_no' => ['required'],
        'photo' => ['nullable'],
    ]);

    if ($validator->fails()) {
        // Notify the user of validation errors
        return redirect()->route('backend.lab-info')
            ->withInput()
            ->withErrors($validator);
    }

    // Find the existing LabInformation record by its ID
    $labInfo = LabInformation::where('lab_information_uuid', $id)->first();

    if (!$labInfo) {
        flash()->addError('Lab Information Not Found');
        return redirect()->route('backend.lab-information');
    }

    // Update the fields with the new data
    $labInfo->lab_information_name = $request->input('lab_name');
    $labInfo->lab_information_room_no = $request->input('room_no');

    if ($request->hasFile('photo')) {
        $fileName = time().$request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $fileName, 'public');
        $photo = '/storage/'.$path;
        $labInfo->lab_information_photo = $photo;
    }

    // Save the updated data
    $labInfo->save();

    // Redirect or respond with a success message
    flash()->addSuccess('Lab Information Updated Successfully');

    // Notify the user of a successful operation
    return redirect()->route('backend.lab-information');
    }


    public function officeHour(Request $request, $id)
    {
        $data = LabInformation::where('lab_information_uuid', $id)->first();
        $day = Day::all();
        $time = TimeSchedule::all();

        return view('backend.ta-information.office-hour', compact('data', 'day', 'time'));
    }


    public function postOfficeHour(Request $request, $id)
    {

        $taInfo = LabInformation::where('lab_information_uuid', $id)->first();
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
        $data = new LabOffieHour();
        $hourData = new LabOffieHourDay();
        $hourData->lab_office_hour_day_lab_uuid = $id;
        $hourData->lab_office_hour_day_day_uuid = $request->input('day');
        $data->lab_offie_hour_lab_uuid = $id;
        $data->lab_offie_hour_day_uuid = $request->input('day');
        $data->lab_offie_hour_start_time = $request->input('start_time');
        $data->lab_offie_hour_end_time = $request->input('end_time');
        $data->lab_offie_hour_subject_code = $request->input('course_code');
        $data->lab_offie_hour_room_no = $request->input('room_no');
        $data->lab_offie_hour_office_hour = $request->input('office_hour');
        $data->lab_offie_hour_idle = $request->input('idle');

        $existingRecord = LabOffieHourDay::where('lab_office_hour_day_day_uuid', $request->input('day'))
        ->where('lab_office_hour_day_lab_uuid', $id)
        ->first();

        if (!$existingRecord) {
            $hourData->save();
        }
        $data->save();

        flash()->addSuccess('Office Hour Added Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.lab-information.view', ['id' => $id]);
    }

    public function delete($id) {
        LabInformation::where('lab_information_uuid', $id)->delete();
        return back();
    }
}
