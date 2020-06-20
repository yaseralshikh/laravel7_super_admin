<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->search, function ($q) use ($request) {

            return $q->where('name', 'like' , '%' . $request->search . '%');

        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);

        })->latest()->paginate(10);

        return view('dashboard.products.index', compact('categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required' , Rule::unique('products'),],
            'description' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ]);

        $request_data = $request->all();

        if ($request->image) {

            Image::make($request->image)
                ->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of if

        if ($request->banner_image) {

            Image::make($request->banner_image)->save(public_path('uploads/product_images/' . $request->banner_image->hashName()));

            $request_data['banner_image'] = $request->banner_image->hashName();

        }//end of if

        if($request->get('display') == null){
            $request_data['display'] = 0;
        } else {
            $request_data['display'] = 1;
        }//end of if

        Product::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required' , Rule::unique('products')->ignore($product->id),],
            'description' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ]);

        $request_data = $request->all();

        if ($request->image) {

            if ($product->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
                    
            }//end of if

            Image::make($request->image)
                ->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of if

        if ($request->banner_image) {

            if ($product->banner_image != 'default_banner.png') {

                Storage::disk('public_uploads')->delete('/product_images/' . $product->banner_image);
                    
            }//end of if

            Image::make($request->banner_image)->save(public_path('uploads/product_images/' . $request->banner_image->hashName()));

            $request_data['banner_image'] = $request->banner_image->hashName();

        }//end of if
        
        if($request->get('display') == null){
            $request_data['display'] = 0;
        } else {
            $request_data['display'] = 1;
        }//end of if

        $product->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/product_images/' . $product->image);

        }//end of if

        $product->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.products.index');
    }
}
