@component('mail::message')
# فاتورة

@component('mail::panel')

تمت عملية الشراء بنجاح .

@endcomponent

@component('mail::table')
| @lang('site.product') | @lang('site.category') | @lang('site.quantity') | @lang('site.price') |
| -- |:----:| -----:| --------:|
@foreach($order->products as $product)
| {{ $product->name }} | {{ $product->category->name }} | {{ $product->pivot->quantity }} | {{ $product->sale_price }} |
@endforeach
@endcomponent

@component('mail::button', ['url' => 'http://moad.yaseralshikh.com/cart/order/' . $order->id . '/invoice' , 'color' => 'green'])
طباعة الفاتورة
@endcomponent


شكراً,<br>
{{ config('app.name') }}
@endcomponent
