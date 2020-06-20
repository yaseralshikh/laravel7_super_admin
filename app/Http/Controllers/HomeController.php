<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\user;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index' , 'search_product']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $categories = Category::with('products')->when($request->id, function ($q) use ($request) {
            return $q->where('id', $request->id );
        })->latest()->get();

        return view('homepage.home' , compact('categories'));
    }// end of index

    public function search_product(Request $request)
    {
        $products = Product::when($request->search, function ($q) use ($request) {
            return $q->where('name', 'like' , '%' . $request->search . '%')
                     ->orWhere('description', 'like', '%' . $request->search . '%');
        })->latest()->get();
        
        return view('homepage.search_product' , compact('products'));
    }// end of search_product

    public function profile($id)
    {

        $user = User::where('id', $id)->first();
        
        if (auth()->user()->id == $id) {
            return view('homepage.profile' , compact('user'));
        } else {
            return abort(404); 
        }
    }// end of profile

    public function edit_profile($id)
    {
        $user = User::find($id);
        if (auth()->user()->id == $id) {
            return view('homepage.edit', compact('user'));
        } else {
            return abort(404); 
        }

    }//end of edit_profile

    public function update_profile(Request $request, $id)
    {
        $user = User::find($id);
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id),],
            'phone' => 'required|digits_between:10,14',
            'address' => 'required',
            'image' => 'image',
        ]);

        $request_data = $request->except('image');

        if ($request->image) {

            if ($user->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/user_images/' . $user->image);

            }//end of inner if

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/user_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of external if

        $user->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return view('homepage.profile' , compact('user'));

    }//end of update

}// end of controller
