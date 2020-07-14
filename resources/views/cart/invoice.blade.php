@extends('layouts.homepage.app')

@section('content')
    <div class="container p-4" dir="rtl">

        <div class="card">

            <div class="card-body" id="print-area">
                <table class="table table-bordered text-center table-responsive-sm">
                    <tr>
                        <td colspan="3">
                            <h1 class="float-right pr-5 pt-3">@lang('site.invoice')</h1>
                            <img class="float-left w-25" src="{{ asset('uploads/laravel_logo.png') }}" class="img-circle" alt="User Image">
                        </td>
                    </tr>
                    <tr class="h4" style="background-color: rgba(231, 231, 231, 0.76)">
                        <td>@lang('site.client_name')</td>
                        <td>@lang('site.phone')</td>
                        <td>@lang('site.email')</td>
                    </tr>
                    <tr class="h5">
                        <td>{{ $order->user->full_name }}</td>
                        <td>{{ $order->user->phone }}</td>
                        <td>{{ $order->user->email }}</td>
                    </tr>
                    <tr class="h4" style="background-color: rgba(231, 231, 231, 0.76)">
                        <td>@lang('site.invoice_number')</td>
                        <td>@lang('site.invoice_data')</td>
                        <td>@lang('site.invoice_price')</td>
                    </tr>
                    <tr class="h5">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->toDateString() }}</td>
                        <td>{{ $order->total_price }}</td>
                    </tr>
                </table>
                <table  class="table table-hover table-bordered table-responsive-sm">
                    <thead class="bg-dark text-white text-center">
                        <tr>
                            <th>@lang('site.product')</th>
                            <th class="text-center">@lang('site.category')</th>
                            <th class="text-center">@lang('site.quantity')</th>
                            <th class="text-center">@lang('site.image')</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
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
            </div>
            <button class="btn btn-primary print-btn"><i class="fa fa-print"></i> @lang('site.print')</button>
        </div>
        
    </div>   

@endsection
