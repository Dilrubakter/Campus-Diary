<?php

namespace App\Http\Controllers;

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
            'photo' => ['nullable', 'file'],
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




}
