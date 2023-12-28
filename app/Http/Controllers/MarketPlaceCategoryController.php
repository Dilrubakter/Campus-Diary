<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketPlaceCategory;

class MarketPlaceCategoryController extends Controller
{
    //

    public function  index() {
        $data = MarketPlaceCategory::paginate(10);
        return view('backend.marketplace.category.index', compact('data'));
    }

    public function create() {
        return view('backend.marketplace.category.create');
        
    }
    public function store(Request $request) {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'category' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()->route('backend.marketplace.category.create')->withErrors($validator)->withInput();
        }

        $data = new MarketPlaceCategory();
        $data->marketplace_category_name = $request->input('category');
        $data->save();

        flash()->addSuccess('Marketplace category added successfully');
        return to_route('backend.marketplace.category');
        
    }

    public function edit(Request $request, $id){
        $data = MarketPlaceCategory::where('marketplace_category_uuid', $id)->first();
        return view('backend.marketplace.category.edit', compact('data'));
    }


    public function update(Request $request, $id) {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'category' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()->route('backend.marketplace.category.create')->withErrors($validator)->withInput();
        }

        $data = MarketPlaceCategory::where('marketplace_category_uuid', $id)->first();

        $data->marketplace_category_name = $request->input('category');
        $data->save();

        flash()->addSuccess('Marketplace category updated successfully');
        return to_route('backend.marketplace.category');
        
    }


    public function delete($id) {
        MarketPlaceCategory::where('marketplace_category_uuid', $id)->delete();
        flash()->addSuccess('Marketplace category deleted successfully');
        return back();
    }
}
