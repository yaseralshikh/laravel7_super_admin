@extends('layouts.homepage.app')

@section('content')
<div class="container p-4" dir="rtl">

    @if ($client->orders->count() > 0)

        <div class="card text-left">
            <div class="card-header text-center" style="background-color: rgb(167, 197, 253)">
                <h4 class="card-title">@lang('site.previous_orders') <small>{{ $orders->total() }}</small></h4>
            </div>
            <div class="card-body text-center">

                @foreach ($orders as $order)

                    <div class="accordion">
                        <div class="card" id="print-area">
                          <div class="card-header">
                            <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseme{{$order->id}}" aria-expanded="true">
                                <h4 >{{ $order->created_at->toDateString() }} <i class="fa fa-caret-square-o-down"></i></h4>
                            </button>
                            </h5>
                          </div>
                      
                          <div id="collapseme{{$order->id}}" class="collapse out ShowHide">
                            <div class="card-body">
                                <table  class="table table-hover table-bordered table-responsive-sm">
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th>@lang('site.product')</th>
                                            <th class="text-center">@lang('site.category')</th>
                                            <th class="text-center">@lang('site.quantity')</th>
                                            <th class="text-center">@lang('site.image')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td class="text-center">{{ $product->category->name }}</td>
                                                <td class="text-center">{{ $product->pivot->quantity }}</td>
                                                <td class="text-center"><img src="{{ $product->image_path }}" style="width: 50px"  class="img-thumbnail" alt=""></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="text-danger">@lang('site.total') : {{ $order->total_price }} $</h4>
                                <a class="btn btn-primary" href="{{ route('cart.invoice',$order->id ) }}"><i class="fa fa-print"></i> @lang('site.invoice')</a>
                            </div>
                          </div>
                        </div>
                    </div>    

                @endforeach

                {{ $orders->links() }}

            </div>
        </div>

    @else

        <h3 class="text-center">@lang('site.no_client_orders')</h3>

    @endif

</div>
@endsection
