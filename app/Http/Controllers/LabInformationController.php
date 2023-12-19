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
            'photo' => ['nullable', 'file'],
        ]);

        if ($validator->fails()) {
            // Notify the user of validation errors
            return redirect()->route('backend.lab-info.create')
                ->withInput()
                ->withErrors($validator);
        }

        $photo = null;

        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $photo = '/storage/'.$path;
        }

        $labInfo = new LabInformation();
        $labInfo->name = $request->input('lab_name');
        $labInfo->room_no = $request->input('room_no');
        $labInfo->photo = $photo;
        $labInfo->save();

        flash()->addSuccess('Lab In formation Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.lab-info.create');
    }

    public function edit(Request $request, $id) {
        $data = LabInformation::where('uuid', $id)->first();
        return view('backend.lab-information.edit', compact('data'));
    }

    public function view(Request $request, $id)
    {
        $data = LabInformation::with(['personOfficeHour', 'personOfficeHour.day', 'personOfficeHour.day.officeHour'])
            ->where('uuid', $id)
            ->first();
        return view('backend.lab-information.view-lab', [
            'data' => $data
        ]);
    }
    // public function view(Request $request, $id) {
    //     $data = LabInformation::where('uuid', $id)->first();
    //     return view('backend.lab-information.view-lab', compact('data'));
    // }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'lab_name' => ['required'],
            'room_no' => ['required'],
            'photo' => ['nullable', 'file'],
        ]);

        if ($validator->fails()) {
            // Notify the user of validation errors
            return redirect()->route('backend.lab-info')
                ->withInput()
                ->withErrors($validator);
        }

        // Find the existing TAInformation record by its ID
        $labInfo = LabInformation::where('uuid', $id)->first();

        if (!$labInfo) {
            flash()->addError('Lab Information Not Found');
        }

        // Update the fields with the new data
        $labInfo->name = $request->input('lab_name');
        $labInfo->room_no = $request->input('room_no');

        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $photo = '/storage/'.$path;
            $labInfo->photo = $photo;
        }
        $labInfo->save(); // Save the updated data

        // Redirect or respond with a success message
        flash()->addSuccess('Lab Information Updated Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.lab-info');
    }

    public function officeHour(Request $request, $id)
    {
        $data = LabInformation::where('uuid', $id)->first();
        $day = Day::all();
        $time = TimeSchedule::all();

        return view('backend.ta-information.office-hour', compact('data', 'day', 'time'));
    }


    public function postOfficeHour(Request $request, $id)
    {

        $taInfo = LabInformation::where('uuid', $id)->first();
        if(!$taInfo){
            flash()->addError('Lab Not Found');
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
        $data = new LabOffieHour();
        $hourData = new LabOffieHourDay();
        $hourData->lab_uuid = $id;
        $hourData->day_uuid = $request->input('day');
        $data->lab_uuid = $id;
        $data->day_uuid = $request->input('day');
        $data->start_time = $request->input('start_time');
        $data->end_time = $request->input('end_time');
        $data->subject_code = $request->input('course_code');
        $data->room_no = $request->input('room_no');
        $data->office_hour = $request->input('office_hour');
        $data->idle = $request->input('idle');
        $data->save();
        $hourData->save();

        flash()->addSuccess('Office Hour Added Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.lab-info.view', ['id' => $id]);
    }
}
