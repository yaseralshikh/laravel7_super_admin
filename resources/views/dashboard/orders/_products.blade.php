<div id="print-area">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <td colspan="3">
                    <h3 style="float:right; padding:15px;"><b>@lang('site.invoice')</b></h3>
                    <img style="width: 30%; float:left; padding-top:20px;" src="{{ asset('uploads/laravel_logo.png') }}">
                </td>
            </tr>
            <tr>
                <th class="text-red text-center">@lang('site.client_name')</th>
                <th class="text-red text-center">@lang('site.phone')</th>
                <th class="text-red text-center">@lang('site.address')</th>
            </tr>
        </thead>
        <tbody>
            <th class="text-center">{{ $order->user->full_name }}</th>
            <th class="text-center">{{ is_array($order->user->phone) ? implode($order->user->phone, '-') : $order->user->phone }}</th>
            <th class="text-center">{{ $order->user->address }}</th>
        </tbody>
    </table>
    <table class="table table-hover table-bordered">
        <thead class="bg-info">
        <tr>
            <th>@lang('site.name')</th>
            <th>@lang('site.quantity')</th>
            <th>@lang('site.price')</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ number_format($product->pivot->quantity * $product->sale_price, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h3>@lang('site.total') <span>{{ number_format($order->total_price, 2) }}</span></h3>

</div>

<button class="btn btn-block btn-primary print-btn"><i class="fa fa-print"></i> @lang('site.print')</button>
