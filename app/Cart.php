<?php

namespace App;

class Cart
{
    public $items = [];
    public $totalQty ;
    public $totalPrice ;
    public $unitTotalPrice ;
    public $stock ;

    public function __Construct($cart = null){
        if ($cart) {
            $this->items = $cart->items;
            $this->totalQty = $cart->totalQty;
            $this->totalPrice = $cart->totalPrice;
            $this->unitTotalPrice = $cart->unitTotalPrice ;
            $this->stock = $cart->stock ;
        } else {
            $this->items =[];
            $this->totalQty = 0;
            $this->totalPrice = 0; 
            $this->unitTotalPrice = 0;
            $this->stock = 0;         
        }
    }

    public function add($product){
        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'sale_price' => $product->sale_price,
            'qty' => 0,
            'stock' => $product->stock,
            'unitTotalPrice' => $product->unitTotalPrice,
            'image' => $product->image_path,
        ];

        if (!array_key_exists($product->id, $this->items )) {
            $this->items[$product->id] = $item ;
            $this->totalQty +=1 ;
            $this->totalPrice += $product->sale_price ;
            $this->unitTotalPrice += $product->unitTotalPrice ;
            $this->stock += $product->stock ;
        } else {
            $this->totalQty +=1 ;
            $this->totalPrice += $product->sale_price ;
            $this->unitTotalPrice += $product->unitTotalPrice ;
            $this->stock += $product->stock ;
        }

        $this->items[$product->id]['qty'] +=1 ;
        $this->items[$product->id]['unitTotalPrice'] = $this->items[$product->id]['qty'] * $this->items[$product->id]['sale_price'] ;
    }

    public function remove($id) {

        if( array_key_exists($id, $this->items)) {
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['qty'] * $this->items[$id]['sale_price'];
            unset($this->items[$id]);
        }

    }

    public function updateQty($id, $qty, $unitTotalPrice) {

        //reset qty and price in the cart ,
        $this->totalQty -= $this->items[$id]['qty'] ;
        $this->totalPrice -= $this->items[$id]['sale_price'] * $this->items[$id]['qty'] ;

        // add the item with new qty
        $this->items[$id]['qty'] = $qty;
        $this->items[$id]['unitTotalPrice'] = $unitTotalPrice ;

        // total price and total qty in cart
        $this->totalQty += $qty ;
        $this->totalPrice += $this->items[$id]['sale_price'] * $qty ;

    }
}
