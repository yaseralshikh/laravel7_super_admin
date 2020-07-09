@extends('layouts.homepage.app')


@section('content')
    <div class="container mt-3">

        <div class="row">
            @if($cart)
                <div class="col-md-12 pb-3">

                    <form action="{{ route('cart.store', Auth::user()->id ) }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        @include('partials._errors')
        
                        <table class="table table-hover">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th class="text-center bg-info"  colspan="6">@lang('site.your_ShoppingCart')</th>
                                </tr>
                                
                                <tr>
                                    <th>@lang('site.image')</th>
                                    <th>@lang('site.product')</th>
                                    <th>@lang('site.price')</th>
                                    <th>@lang('site.quantity')</th>
                                    <th>@lang('site.total')</th>
                                    <th>@lang('site.delete')</th>
                                </tr>
                            </thead>
            
                            <tbody class="order-list bg-light">
                                @foreach( $cart->items as $product)
                                <tr>
                                    <td width="25%"><img src="{{ $product['image'] }}" width="35%" alt="" class="img-thumbnail float-left mr-3"></td>
                                    <td>{{ $product['name'] }}</td>
                                    <td class="product-price">{{ number_format($product['sale_price'],2) }}</td> 
                                    <td><input type="number" name="products[{{$product['id']}}][quantity]" data-id="{{ $product['id'] }}" data-price="{{ number_format($product['sale_price'],2) }}" data-unitTotalPrice="$product['unitTotalPrice']" data-url='{{ route('cart.update', $product['id'] )}}' data-method="PUT" class="form-control input-sm product-quantity" min="1" max="{{ $product['stock']}}" value={{ $product['qty']}}></td>
                                    <td class="unitTotalPrice">{{ number_format($product['unitTotalPrice'],2) }}</td> 
                                    <td>
                                        <button type="submit" class="btn btn-danger btn-sm remove-product-btn" data-id="{{$product['id']}}" data-url='{{ route('cart.remove', $product['id'] )}}' data-method="delete"><span class="fa fa-trash"></span></button>
                                    </td>
                                </tr>
                                @endforeach
            
                            </tbody>
            
                        </table><!-- end of table -->

                        <hr>

                        <h4 class="float-right">@lang('site.quantity') : <b class="products-quantity">{{$cart->totalQty}}</b></h4>
                        <h4 class="float-left">@lang('site.total') : <b class="total-price">$ {{$cart->totalPrice}}</b></h4>

                        <button class="btn btn-primary btn-block" id="add-order-form-btn"><i class="fa fa-plus"></i> @lang('site.add_order')</button>

                    </form>

                </div>

            @else
                <p>@lang('site.cart_empty')</p>
            @endif
        </div>
    </div>

@endsection