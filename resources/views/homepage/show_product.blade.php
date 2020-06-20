@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card-body p-lg-0">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        
            <!-- Page Content -->
            <div class="col-md-12">
                <div class="container p-4">
                    <div class="col-md-12 p-3 mb-2 bg-primary border border-dark text-white rounded text-center">
                        <h1>{{ ucfirst(trans($product->name)) }}</h1>
                    </div>
                    <div class="card">
                        <div class="row">
                            <aside class="col-sm-5 border-right">
                                <article class="gallery-wrap"> 
                                    <div class="img-big-wrap">
                                        <div><img class="w-100" src="{{ $product->image_path }}"></div>
                                    </div> <!-- slider-product.// -->
                                </article> <!-- gallery-wrap .end// -->
                            </aside>
                            <aside class="col-sm-7">
                                <article class="card-body p-5">
                                    <dl class="item-property">
                                        <dd><p>{!! $product->description !!}</p></dd>
                                    </dl>
                                    <p class="price-detail-wrap"> 
                                        <span class="price h3"> 
                                            <span class="text-danger">US $ {{ $product->sale_price }}</span>
                                            <span class="h6">/ @lang('site.stock') {{ $product->stock }}</span>
                                        </span> 
                                    </p> <!-- price-detail-wrap .// -->
                                    <hr>
                                    <a href="#" class="btn btn-lg btn-primary text-uppercase"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> @lang('site.add_to_cart')</a>
                                </article> <!-- card-body.// -->
                            </aside> <!-- col.// -->
                        </div> <!-- row.// -->
                    </div> <!-- card.// -->
                </div>
            </div>
        </div>
    </div>
@endsection
