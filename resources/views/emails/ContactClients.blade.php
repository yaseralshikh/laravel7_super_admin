@component('mail::message')
# فاتورة

تمت عملية الشراء بنجاح .

@component('mail::button', ['url' => 'http://moad.yaseralshikh.com/cart/order/' . $order->id . '/invoice' , 'color' => 'green'])
طباعة الفاتورة
@endcomponent


@component('mail::panel')
    <table  class="table table-hover table-bordered table-responsive-sm">
        <thead class="bg-dark text-white text-center">
            <tr>
                <th>@lang('site.product')</th>
                <th class="text-center">@lang('site.category')</th>
                <th class="text-center">@lang('site.quantity')</th>
                <th class="text-center">@lang('site.price')</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($order->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td class="text-center">{{ $product->category->name }}</td>
                    <td class="text-center">{{ $product->pivot->quantity }}</td>
                    <td class="text-center">{{ $product->sale_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endcomponent


شكراً,<br>
{{ config('app.name') }}
@endcomponent
