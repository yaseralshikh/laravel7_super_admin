@extends('layouts.homepage.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">

            {{-- <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div> --}}

            <!-- Page Content -->
            <div class="container">
                {{-- @foreach ($categories as $category)
                    
                    <div class="panel-body">

                        @if ($category->products->count() > 0)

                            <table class="table table-hover table-responsive-sm">
                                <tr>
                                    <th>@lang('site.name')</th>
                                    <th>@lang('site.stock')</th>
                                    <th>@lang('site.price')</th>
                                    <th>@lang('site.add')</th>
                                </tr>

                                @foreach ($category->products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ number_format($product->sale_price, 2) }}</td>
                                        <td>
                                            <a href=""
                                                id="product-{{ $product->id }}"
                                                data-name="{{ $product->name }}"
                                                data-id="{{ $product->id }}"
                                                data-price="{{ $product->sale_price }}"
                                                class="btn btn-success btn-sm add-product-btn">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </table><!-- end of table -->

                        @else
                            <h5>@lang('site.no_records')</h5>
                        @endif

                    </div><!-- end of panel body -->

                @endforeach --}}

                <!-- Page slides -->
                @include('layouts.homepage._slides')
                
                <!-- Page Features -->
                @if($categories->count() > 0)
                    @foreach ($categories as $category)
                        <div class="card mt-2">
                            @if ($category->products->count() > 0)
                                <div class="card-header text-center" style="background-color:rgb(229, 242, 250)">
                                    <h3><b>{{ ucfirst(trans($category->name)) }}</b> <i class="fa fa-folder-open" aria-hidden="true"></i></h3>
                                </div>
                                <div class="row text-center">
                                    @foreach ($category->PaginatedProducts as $product)
                                        <div class="col-lg-3 col-md-6 mb-4">
                                            <div class="card h-100 m-3">
                                                <div class="card-header text-center shadow bg-info">
                                                    <a href="{{ route('show_product', $product->id ) }}"><h4 class="card-title bg-white  p-2 shadow border border-dark"><b>{{ ucfirst(trans($product->name)) }}</b></h4></a>
                                                </div>
                                                <img class="card-img-top mx-auto mt-3 w-60" data-action="zoom" src="{{ $product->image_path }}" alt="">
                                                <div class="card-body" style="margin-top: 10px;">
                                                    <p class="card-text">{!!  Str::limit($product->description, 190, $end = ' ... ') !!} @if (Str::length($product->description) > 190) <a href='{{ route('show_product' , $product->id ) }}' class='fa fa-hand-o-left'> المزيد</a> @endif </p>
                                                </div>
                                                <div class="card-footer">
                                                    <p class="card-text list-group-item">@lang('site.price') : {{ $product->sale_price }} $</p>
                                                    <p class="card-text list-group-item">@lang('site.stock') : {{ $product->stock }}</p>
                                                    {{-- <a href="{{ route('cart.add', $product->id ) }}" class="btn btn-primary btn-lg btn-block add_to_cart">@lang('site.add_to_cart')</a> --}}
                                                    @if ($product->stock > 0)
                                                        <button type="button" data-url="{{ route('cart.add', $product->id ) }}" class="btn btn-primary btn-lg btn-block add_to_cart">@lang('site.add_to_cart')</button>
                                                    @else
                                                        <button type="button" class="btn btn-secondary btn-lg btn-block disabled">@lang('site.notAvailable')</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- /.row -->
                            @endif
                        </div>
                    @endforeach
                @endif
                {{ $category->PaginatedProducts->links() }}
            </div>
            <!-- /.container -->
        </div>
    </div>
@endsection
