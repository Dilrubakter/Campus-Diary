<?php

namespace App\Http\Controllers;

use App\Models\TimeSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TimeScheduleController extends Controller
{
    public function index() {

        try {
            $data = TimeSchedule::all();

            if ($data) {
                // $jsonData = json_encode($data); // Convert data to JSON

                return view('backend.timeslot.index', compact('data'));
            }
        } catch (\Exception $e) {
            // Handle the exception here, e.g., log the error or display an error message
            Log::error("Error: " . $e->getMessage());
        }

    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_time' => ['required'],
            'end_time' => ['required'],
        ]);

        if ($validator->fails()) {
            // Notify the user of validation errors
            return redirect()->route('backend.timeschedule')
                ->withInput()
                ->withErrors($validator);
        }

        // Create a new TimeSchedule instance and save it to the database
        $timeSchedule = new TimeSchedule();
        $timeSchedule->start_time = $request->input('start_time');
        $timeSchedule->end_time = $request->input('end_time');
        $timeSchedule->save();

        flash()->addSuccess('Time Slot created Successully');

        // Notify the user of a successful operation
        return redirect()->route('backend.timeschedule');
    }

    public function create()
    {
        return view('backend.timeslot.create');
    }

    public function delete($id)
    {
        // Find the record by ID
        $record = TimeSchedule::find($id);
        if (!$record) {
            return response()->json(['message' => 'Record not found.'], 404);
        }
        // Delete the record
        $record->delete();

        return response()->json(['message' => 'Record deleted.'], 200);
    }

}
