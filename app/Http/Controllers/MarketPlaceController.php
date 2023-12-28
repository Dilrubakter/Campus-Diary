<?php

namespace App\Http\Controllers;

use App\Models\MaketPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarketPlaceController extends Controller
{
    //

    function index() {
        $category = \App\Models\MarketPlaceCategory::get();
        $data = MaketPlace::with(['users', 'category'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('frontend.marketplace.marketplace', [
            'category' => $category,
            'data' => $data
        ]);
    }


    function create()  {
        $category = \App\Models\MarketPlaceCategory::get();
        return view('frontend.marketplace.add-product', compact('category'));
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'category' => ['nullable'],
            'description' => ['required'],
            'price' => ['nullable'],
            'photo' => ['nullable'],
        ]);
    
        if ($validator->fails()) {
            // Notify the user of validation errors
            return redirect()->route('marketplace.add-product')
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
        $product = new MaketPlace;
        $product->marketplace_product_category = $request->input('category');
        $product->marketplace_person_uuid = auth()->user()->id;
        $product->marketplace_product_name = $request->input('name');
        $product->marketplace_product_description = $request->input('description');
        $product->marketplace_product_price = $request->input('price');
        $product->marketplace_product_photo = $photo;
        $product->save();

        flash()->addSuccess('Product Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('marketplace.add-product');
    }
}
