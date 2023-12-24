<?php

namespace App\Http\Controllers;

use view;
use Illuminate\Http\Request;
use App\Models\ClubInformation;
use Illuminate\Support\Facades\Validator;

class ClubInformationController extends Controller
{
    function index() {
        $data = \App\Models\ClubInformation::all();
        return view('backend.club-information.index', compact('data'));
    }

    function create() {
        return view('backend.club-information.create');
    }

    function store(Request $request)  {
        $validator = Validator::make($request->all(), [
            'club_name' => ['required'],
            'club_short_name' => ['required'],
            'overview' => ['nullable'],
            'photo' => ['nullable', 'file'],
        ]);

        if ($validator->fails()) {
            // Notify the user of validation errors
            return redirect()->route('backend.club-information.create')
                ->withInput()
                ->withErrors($validator);
        }

        $photo = '';

        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $photo = '/storage/'.$path;
        }

        $clubInfo = new \App\Models\ClubInformation();
        $clubInfo->club_information_name = $request->input('club_name');
        $clubInfo->club_information_short_name = $request->input('club_short_name');
        $clubInfo->club_information_overview = $request->input('overview');
        $clubInfo->club_information_photo = $photo;
        $clubInfo->save();

        flash()->addSuccess('Club Information Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.club-information.create');
    }

    public function view(Request $request, $id)
    {
        $data = ClubInformation::with('panelMembers')->where('club_information_uuid', $id)->first();

    
        // dd($data->toJson(JSON_PRETTY_PRINT));

        return view('backend.club-information.view-profile', [
            'data' => $data->toJson(JSON_PRETTY_PRINT)
        ]);
    }

    function addPanelMember(Request $request, $id) {
        $data = \App\Models\ClubInformation::where('club_information_uuid', $id)->get()
        ->first();

        return view('backend.club-information.add-panel-member', compact('data'));
    }

    function storePanelMember(Request $request, $id)  {
        $validator = Validator::make($request->all(), [
            'member_name' => ['required'],
            'position' => ['required'],
            'photo' => ['nullable', 'file'],
        ]);

        if ($validator->fails()) {
            // Notify the user of validation errors
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        $photo = '';

        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $photo = '/storage/'.$path;
        }

        $clubInfo = new \App\Models\ClubInformationPanelMember();
        $clubInfo->club_information_panel_members_club_information_uuid = $id;
        $clubInfo->club_information_panel_members_name = $request->input('member_name');
        $clubInfo->club_information_panel_members_designation = $request->input('position');
        $clubInfo->club_information_panel_members_photo = $photo;
        $clubInfo->save();

        flash()->addSuccess('Panel Member Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.club-information.view', ['id' => $id]);
    }
    

    public function edit(Request $request, $id) {
        $data = ClubInformation::where('club_information_uuid', $id)->first();
        return view('backend.club-information.edit', compact('data'));
    }

    public function update(Request $request, $id)
    { 
        $validator = Validator::make($request->all(), [
            'club_name' => ['required'],
            'club_short_name' => ['required'],
            'overview' => ['nullable'],
            'photo' => ['nullable', 'file'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('backend.club-information.edit', ['id' => $id])
                ->withInput()
                ->withErrors($validator);
        }

        // Find the existing TAInformation record by its ID
        $clubInfo = ClubInformation::where('club_information_uuid', $id)->first();

        if (!$clubInfo) {
            flash()->addError('Club Not Found');
            return redirect()->route('backend.club-information.edit', ['id' => $id]);
        }

        $clubInfo->club_information_name = $request->input('club_name');
        $clubInfo->club_information_short_name = $request->input('club_short_name');
        $clubInfo->club_information_overview = $request->input('overview');


        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $photo = '/storage/'.$path;
            $clubInfo->club_information_panel_members_photo = $photo;
        }
        $clubInfo->save(); // Save the updated data

        // Redirect or respond with a success message
        flash()->addSuccess('Club Updated Successfully');

        // Notify the user of a successful operation
        return redirect()->route('backend.club-information');
    }

    public function delete($id) {
        ClubInformation::where('club_information_uuid', $id)->delete();
        flash()->addSuccess('Club Information Deleted Successfully');
        return back();
    }

}
