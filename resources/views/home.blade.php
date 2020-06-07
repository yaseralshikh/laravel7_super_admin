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

                    <!-- Jumbotron Header -->
                    <header class="jumbotron">
                        <!-- Heading Row -->
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                            <img class="img-fluid rounded mb-4 mb-lg-0" style="width:100%" src="uploads/product_images/{{ $randomProducts[0]->image }}" alt="">
                            </div>
                            <!-- /.col-lg-8 -->
                            <div class="col-lg-5">
                            <h1 class="font-weight-light">{{ $randomProducts[0]->name}}</h1>
                            <p>{!!  $randomProducts[0]->description !!}</p>
                            <p class="card-text list-group-item">Price : {{ $randomProducts[0]->sale_price }} $</p>
                            <p class="card-text list-group-item">Stock : {{ $randomProducts[0]->stock }}</p>
                            <a class="btn btn-primary" href="#">Sale</a>
                            </div>
                            <!-- /.col-md-4 -->
                        </div>
                        <!-- /.row -->
                    </header>
                    
                    <!-- Page Features -->
                    @foreach ($categories as $category)
                        <div class="card">
                            <div class="card-header">
                                {{  $category->name}}
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
                    {{ $category->PaginatedProducts->links() }}
                </div>
                <!-- /.container -->
        </div>
    </div>
@endsection
