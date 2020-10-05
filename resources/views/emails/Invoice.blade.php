@component('mail::message')
# Hello

Your Invoice Detail
@component('mail::table')
    | Your item Name| Quantity      | Price |
@endcomponent

   @foreach($carts as $cart)
       @component('mail::table')
     | {{$cart->product->name}}| {{$cart->price}}|
       @endcomponent
   @endforeach
@component('mail::table')
             |Total Charge   |  {{$total_price}} |
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
