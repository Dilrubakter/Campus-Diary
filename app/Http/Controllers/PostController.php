<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    function index() {
        $data = \App\Models\Post::with(['users'])
                // ->where('created_by', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
                
        return view('frontend.posts.posts', [
            'data' => $data
        ]);
    }
    // function index() {
    //     $data = \App\Models\Post::with(['users'])
    //             ->where('created_by', auth()->user()->id)
    //             ->paginate(3);
    //     return view('frontend.posts.posts', [
    //         'data' => $data
    //     ]);
    // }

    function create() {
        return view('frontend.posts.add-post');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => ['required'],
            'lost' => ['nullable'],
            'found' => ['nullable'],
            'photo' => ['nullable'],
        ]);

        if ($validator->fails()) {
            // Notify the user of validation errors
            return redirect()->route('addPost')
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
        $post = new \App\Models\Post();
        $post->post_post_description = $request->input('message');
        $post->post_post_lost = $request->input('lost');
        $post->posts_post_found = $request->input('found');
        $post->post_product_photo = $photo;
        $post->save();

        flash()->addSuccess('Post Added Successfully');

        // Notify the user of a successful operation
        return redirect()->route('addPost');
    }

}
