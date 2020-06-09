<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
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
        $this->middleware('auth')->except('index');
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

        return view('home' , compact('categories', 'randomProducts'));
    }
}
