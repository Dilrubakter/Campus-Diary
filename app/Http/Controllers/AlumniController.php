<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class AlumniController extends Controller
{
    //

    public function index() {

        $data = Alumni::all();

        return view('backend.alumni.index', compact('data'));
    }

    public function create() {
        return view('backend.alumni.create');
    }


    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'designations' => ['required'],
            'current_working_company' => ['nullable'],
            'current_location' => ['required'],
            'linkedin_profile_link' => ['required'],
            'photo' => ['nullable']
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


        $alumni = new Alumni();
        $alumni->first_name = $request->input('first_name');
        $alumni->last_name = $request->input('last_name');
        $alumni->designations = $request->input('designations');
        $alumni->current_working_company = $request->input('current_working_company');
        $alumni->current_location = $request->input('current_location');
        $alumni->linkedin_profile_link = $request->input('linkedin_profile_link');
        $alumni->photo = $photo;
        $alumni->save();

        flash()->addSuccess('Alumni Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.alumni-information.create');
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'designations' => ['required'],
            'current_working_company' => ['nullable'],
            'current_location' => ['required'],
            'linkedin_profile_link' => ['required'],
            'photo' => ['nullable']
        ]);

        if ($validator->fails()) {
            flash()->addError('Alumni information Not found.');
            return redirect()->route('backend.alumni-information.create')
                ->withInput()
                ->withErrors($validator);
        }

        // Find the existing TAInformation record by its ID
        $alumni = Alumni::where('uuid', $id)->first();

        if (!$alumni) {
            flash()->addError('TA Not Found');
        }

        // Update the fields with the new data
        $alumni->first_name = $request->input('first_name');
        $alumni->last_name = $request->input('last_name');
        $alumni->designations = $request->input('designations');
        $alumni->current_working_company = $request->input('current_working_company');
        $alumni->current_location = $request->input('current_location');
        $alumni->linkedin_profile_link = $request->input('linkedin_profile_link');


        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $photo = '/storage/'.$path;
            $alumni->photo = $photo;
        }
        $alumni->save(); // Save the updated data

        // Redirect or respond with a success message
        flash()->addSuccess('Alumni Updated Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.alumni-information');
    }


    public function edit (Request $request, $id)
    {
        $data = Alumni::where('uuid', $id)->first();
        return view('backend.alumni.edit', compact('data'));

    }


    public function delete($id) {
        Alumni::where('uuid', $id)->delete();
        flash()->addSuccess('Alumni Information Deleted Successfully');
        return back();
    }
}
