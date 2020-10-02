@component('mail::message')
# Hello

Your Invoice Detail
@component('mail::table')
    | Your item Name| Quantity      | Price |
    | ------------- |:-------------:| --------:|
   @foreach($carts as $cart)
    |      {{$cart->product->name}}     |     {{$cart->quantity}}         |     {{$cart->price}}   |
   @endforeach
    |               | Total Charge  |     {{$total_price}}
    @endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
