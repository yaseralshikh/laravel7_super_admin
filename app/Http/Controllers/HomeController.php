<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\user;
use DB;

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
        $randomProducts = DB::table('products')->inRandomOrder()->get();

        $categories = Category::with('products')->when($request->id, function ($q) use ($request) {
            return $q->where('id', $request->id );
        })->latest()->get();

        // $categories = Category::with('products')->when($request->id, function ($q) use ($request) {
        //     return $q->where('id', $request->id );
        // })->whereHas('products', function($q) use ($request) {
        //     $q->where('name', 'like' , '%' . $request->search . '%');
        // })->latest()->get();

        // $categories = Category::with('products')->whereHas('products', function($q) use ($request) {
        //     $q->where('name', 'like' , '%' . $request->search . '%');
        // })->when($request->id, function ($q) use ($request) {return $q->where('id', $request->id );})->latest()->get();

        // $categories = DB::table('categories')
        //     ->join('products', 'products.category_id', '=', 'categories.id')
        //     ->select('categories.*', 'products.*')
        //     ->get();

        return view('homepage.home' , compact('categories', 'randomProducts'));
    }

    public function search_product(Request $request)
    {
        $products = Product::when($request->search, function ($q) use ($request) {
            return $q->where('name', 'like' , '%' . $request->search . '%')
                     ->orWhere('description', 'like', '%' . $request->search . '%');
        })->latest()->get();
        
        return view('homepage.search_product' , compact('products'));
    }

    public function profile($id)
    {

        $user = User::where('id', $id)->first();
        
        if (auth()->user()->id == $id) {
            return view('homepage.profile' , compact('user'));
        } else {
            return abort(404); 
        }
        
        
    }
}
