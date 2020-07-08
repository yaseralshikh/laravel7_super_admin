<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;
use App\user;
use App\Order;
use Illuminate\Http\Request;

use Log;

class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
            return view('cart.show' , compact('cart'));
        } else {
            $cart =null;
            session()->flash('success', __('site.cart_empty'));
        }
        return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $client =  User::find($id);

        $this->attach_order($request, $client);
        session()->forget('cart');

        session()->flash('success', __('site.added_successfully'));
        $order = $client->orders()->with('products')->latest()->first();
        return redirect()->route('cart.invoice', compact('order'));
    }


    public function client_orders($id)
    {
        $client =  User::find($id);
        $orders = $client->orders()->with('products')->latest()->paginate(10);

        if (auth()->user()->id == $id) {
            return view('cart.client_orders', compact( 'client','orders'));
        } else {
            return abort(404); 
        }
    }

    public function invoice($id){

        $order = Order::find($id);
        return view('cart.invoice', compact('order'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1'
        ]);

        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($id, $request->qty, $request->unitTotalPrice);

        session()->put('cart', $cart);
        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = new Cart( session()->get('cart'));
        $cart->remove($id);
        //dd($cart);

        if( $cart->totalQty <= 0 ) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        //session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('cart.show' , compact('cart'));
    }

    public function addToCart(Product $product){
        
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $cart->add($product);
        session()->put('cart', $cart);
        session()->flash('success', __('تم اضافة المنتج الى سلة مشترياتك بنجاح .'));
        return response()->json([ 'cart_quantity' => $cart->totalQty , 'success'=>'تم اضافة المنتج الى سلة مشترياتك بنجاح .']);
    }

    private function attach_order($request, $client)
    {
        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::FindOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];

            $product->update([
                'stock' => $product->stock - $quantity['quantity']
            ]);

        }//end of foreach

        $order->update([
            'total_price' => $total_price
        ]);

    }//end of attach order

    private function detach_order($order)
    {
        foreach ($order->products as $product) {

            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);

        }//end of for each

        $order->delete();

    }//end of detach order
}
