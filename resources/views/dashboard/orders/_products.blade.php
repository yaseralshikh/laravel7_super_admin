<div id="print-area">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-red">@lang('site.client_name')</th>
                <th class="text-red">@lang('site.phone')</th>
                <th class="text-red">@lang('site.address')</th>
            </tr>
        </thead>
        <tbody>
            <th>{{ $order->client->name }}</th>
            <th>{{ is_array($order->client->phone) ? implode($order->client->phone, '-') : $order->client->phone }}</th>
            <th>{{ $order->client->address }}</th>
        </tbody>
    </table>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>@lang('site.product')</th>
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
