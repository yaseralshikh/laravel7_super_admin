@extends('layouts.app')

@section('content')
    {{-- <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

                <!-- Page Content -->
                <div class="container">
                    
                    <!-- Page Features -->
                    <div class="card-body">
                        @if ($products->count() > 0)
                            <div class="row text-center">
                                <div class="col-md-12 p-3 mb-2 bg-primary border border-dark text-white rounded">
                                    <h1>Search Product</h1>
                                </div>
                                @foreach ($products as $product)
                                    <div class="col-lg-3 col-md-6 mb-4">
                                        <div class="card h-100">
                                            <img class="card-img-top mx-auto" src="{{ $product->image_path }}" alt="">
                                            <div class="card-body">
                                                <h4 class="card-title">{{ $product->name }}</h4>
                                                <p class="card-text">{!! $product->description !!}</p>
                                            </div>
                                            <div class="card-footer">
                                                <p class="card-text list-group-item">Price : {{ $product->sale_price }} $</p>
                                                <p class="card-text list-group-item">Stock : {{ $product->stock }}</p>
                                                <a href="#" class="btn btn-primary btn-lg btn-block">sale</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- /.row -->
                        @endif
                    </div>
                </div>
                <!-- /.container -->
            </div>
        </div>
    </div> --}}

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
                        <h1>Search Products</h1>
                    </div>
                    @if ($products->count() > 0)
                        @foreach ($products as $product)
                        <div class="card">
                            <div class="row">
                                <aside class="col-sm-5 border-right">
                                    <article class="gallery-wrap"> 
                                        <div class="img-big-wrap">
                                            <div> <a href="#"><img class="rounded mx-auto d-block p-3 w-70" src="{{ $product->image_path }}"></a></div>
                                        </div> <!-- slider-product.// -->
                                    </article> <!-- gallery-wrap .end// -->
                                </aside>
                                <aside class="col-sm-7">
                                    <article class="card-body p-5">
                                        <h3 class="title mb-3 text-success">{{ ucfirst(trans($product->name)) }}</h3>
                                        
                                        <p class="price-detail-wrap"> 
                                            <span class="price h3 text-danger"> 
                                                <span class="currency">US $</span><span class="num">{{ $product->sale_price }}</span>
                                            </span> 
                                        </p> <!-- price-detail-wrap .// -->
                                        <dl class="item-property">
                                            <dt>Description</dt>
                                            <dd><p>{!! $product->description !!}</p></dd>
                                        </dl>
                                        <dl class="param param-feature">
                                            <dt>Stock</dt>
                                            <dd>{{ $product->stock }}</dd>
                                        </dl>  <!-- item-property-hor .// -->
                                        <hr>
                                        @if ($product->stock > 0)
                                            <button type="button" data-url="{{ route('cart.add', $product->id ) }}" class="btn btn-primary btn-lg add_to_cart">@lang('site.add_to_cart')</button>
                                        @else
                                            <button type="button" class="btn btn-secondary btn-lg disabled">@lang('site.notAvailable')</button>
                                        @endif
                                    </article> <!-- card-body.// -->
                                </aside> <!-- col.// -->
                            </div> <!-- row.// -->
                        </div> <!-- card.// -->
                        @endforeach
                    @else
                        <h1 class="border border-dark rounded text-center p-4">@lang('site.no_data_found') مطابقة</h1>   
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
