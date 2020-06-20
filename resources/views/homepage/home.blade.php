@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
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
                {{-- @foreach ($categories as $category)
                    
                    <div class="panel-body">

                        @if ($category->products->count() > 0)

                            <table class="table table-hover">
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
                @include('layouts._slides')
                
                <!-- Page Features -->
                @if($categories->count() > 0)
                    @foreach ($categories as $category)
                        <div class="card mt-2">
                            <div class="card-header text-center" style="background-color:rgb(229, 242, 250)">
                                <h3><b>{{ ucfirst(trans($category->name)) }}</b> <i class="fa fa-folder-open" aria-hidden="true"></i></h3>
                            </div>
                            <div class="card-body">
                                @if ($category->products->count() > 0)
                                    <div class="row text-center">
                                        @foreach ($category->PaginatedProducts as $product)
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
                    @endforeach
                @endif
                {{ $category->PaginatedProducts->links() }}
            </div>
            <!-- /.container -->
        </div>
    </div>
@endsection
