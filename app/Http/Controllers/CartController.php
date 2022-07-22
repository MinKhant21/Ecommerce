<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\order;
use App\Models\OrderGroup;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addtocart($slug){
       $checkproduct =  Product::where('slug',$slug)->first();
       if(!$checkproduct){
            return redirect('/')->with('error','Dont have Product');
       }


       $user_product = Cart::where('user_id',auth()->id())->where('product_id',$checkproduct->id)->first();
       if(!$user_product){
          Cart::create([
               'user_id' => auth()->id(),
               'product_id' => $checkproduct->id,
               'total_quantity' => 1,
          ]);
       }else{
          $user_product->update([
               'total_quantity'=> DB::raw('total_quantity+1'),
          ]);
       }     
       return redirect()->back()->with('success','Added to Carted');
    }

    public function showCart(){
      $carts = Cart::where('user_id',auth()->id())
               ->with('product')
               ->get();
      
      
      return view('cart',compact('carts'));
    }
    public function removeCart($id)
    {
        Cart::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Remove Product From Cart');
    }

    public function checkOut()
    {
        //order store
        $orderGroup =  OrderGroup::create([
            'user_id' => auth()->id(),
            'order_date' => date('Y-m-d'),
        ]);

        $cart = Cart::where('user_id', auth()->id());
        foreach ($cart->get() as $c) {
            order::create([
                'order_group_id' => $orderGroup->id,
                'user_id' => auth()->id(),
                'product_id' => $c->product_id,
                'total_quantity' => $c->total_quantity,
            ]);
        }
        //cart clear
        $cart->delete();
        return redirect('/')->with('success', 'Check Out Succes Please Wait');
    }
}
