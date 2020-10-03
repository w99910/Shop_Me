<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Exports\UsersExport;
use App\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
   public function export(){
    return Excel::download(new ProductsExport(),'products.xlsx');
   }
     public function __construct(){
       $this->middleware('auth');
     }
    public function editing(Request $request,$id){
        $product=Product::find($id);
        $discount=(int)$request[2];

        if($request[0] !== null && $request[1] !==null){

            $product->name=$request[0];
            $product->price= (float)$request[1];
            $product->save();
            if($this->checkDiscount($discount)){
                $discounts=$product->discounts;
                if($discounts->isEmpty()){
                    $product->discounts()->attach($discount);

                }
                else{
                    $product->discounts()->detach();
                    $product->discounts()->attach($discount);
                }
            }
            return 'Product Successfully Edited';
        }
        if($request[0] === null && $request[1] !== null) {

            $product->price= (float)$request[1];
            $product->save();
            if($this->checkDiscount($discount)){
                $discounts=$product->discounts;
                if($discounts->isEmpty()){
                    $product->discounts()->attach($discount);

                }
                else{
                    $product->discounts()->detach();
                    $product->discounts()->attach($discount);
                }
            }
            return 'Product Price Successfully Edited';
        }
       if ($request[1] === null && $request[0] !== null ) {

            $product->name = $request[0];
            $product->save();

            if($this->checkDiscount($discount)){
                $discounts=$product->discounts;
                if($discounts->isEmpty()){
                    $product->discounts()->attach($discount);

                }
                else{
                    $product->discounts()->detach();
                    $product->discounts()->attach($discount);
                }
            }
            return 'Product Name Successfully Edited';
        }
        if($request[0]===null && $request[1]===null) {

            if ($this->checkDiscount($discount)) {
                $discounts = $product->discounts;
                if ($discounts->isEmpty()) {
                    $product->discounts()->attach($discount);

                } else {
                    $product->discounts()->detach();
                    $product->discounts()->attach($discount);
                }
                return 'Product Discount added';
            }

        }
    }
    public function checkDiscount($discount){
            return $discount !== 0 ;
    }
    public function purchase($id){
       $product=Product::find($id);
return view('purchase',compact('product'));
    }

}
