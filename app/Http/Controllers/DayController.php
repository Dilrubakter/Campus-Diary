<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DayController extends Controller
{
    //index

    public function index() {
        try {
            $data = Day::all();
            return view('backend.admin-settings.day.index', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
        }


    }


    public function create() {
        return view('backend.admin-settings.day.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'day' => ['required'],
            'short_name' => ['required']
        ]);

        if ($validator->fails()) {
            // Notify the user of validation errors
            return redirect()->route('backend.day.create')
                ->withInput()
                ->withErrors($validator);
        }

        // Create a new TimeSchedule instance and save it to the database
        $day = new Day();
        $day->day = $request->input('day');
        $day->short_name = $request->input('short_name');
        $day->save();

        flash()->addSuccess('Day Added Successully');

        // Notify the user of a successful operation
        return redirect()->route('backend.day.create');
    }

}
