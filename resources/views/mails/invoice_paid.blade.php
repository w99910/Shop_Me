<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <style>

       body{
           font-family: 'Poppins', sans-serif;
       box-sizing: border-box;
       margin:0;
       padding:0;
       }
        .h-screen{
            min-height:100vh;

        }
        .w-full{
            min-width: 100vw;
        }
        .justify-center{
            justify-content: center;
        }
        .items-center{
            align-items: center;
        }
        .flex{
            display: flex;
        }
        .w-1-3{
        width:33%;
        }
        .flex-col{
            flex-direction: column;
        }
        .bg-white{
            background-color: white;
        }
        .overflow-hidden{
            overflow:hidden;
        }
        .px-16{
            padding-left:16px ;
            padding-right:16px ;
        }
          .bg-green-400{
              background-color: #0c5460;
          }
          .p-3 {
              padding:3px;
          }
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}

    </style>
</head>
<body style=" font-family: 'Poppins', sans-serif;">
<div style=" width: 100%; ">
           <h2>Hello, This is admin from ShopMe ... I hope you are doing well</h2>
           <h3>Yay !!! You just checkout successfully .</h3>
        <h4>Here is your Invoice .</h4>
       </div>
       {{--        <div class="table-row">--}}

{{--            <div class="table-cell px-2 py-1 border border-white border-2">Item Name</div>--}}
{{--            <div class="table-cell px-2 py-1 border border-white border-2">Item Quantity</div>--}}

{{--            <div class="table-cell px-2 py-1 border border-white border-2">Item Price</div>--}}
{{--        </div>--}}
        <div style="overflow-x:auto;">
            <table>
                <tr style="background-color: #f2f2f2">
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
              @foreach($carts as $cart)
                <tr>
                  <td>{{$cart->product->name}}</td>
                  <td>{{$cart->quantity}}</td>
                  <td>${{$cart->price}}</td>
                </tr>
                @endforeach
                <tr style="background-color: #f2f2f2">
                    <td>Total Charge</td>
                <td>${{$total_price}}</td>
                <td></td>
                </tr>
            </table>
        </div>
<h4>Thanks You .... Have a great day!!</h4>

</body>
</html>
