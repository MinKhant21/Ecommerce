<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request){
        $product = Product::latest()
        ->with('category');
        
        $category = Category::all();
        $color = Color::all();
        $brand = Brand::all();

        if($request->category){
            $find_category = Category::where('slug',$request->category)->first();
            if(!$find_category){
                return redirect('/')->with('error','Wrong category');
            }
            $category_id = $find_category->id;
            $product->where('category_id',$category_id);
        }

        if($request->brand){
            $find_brand = Brand::where('slug',$request->brand)->first();
            if(!$find_brand){
                return redirect('/')->with('error','Wrong brand');
            }
            $brand_id = $find_brand->id;
            $product->where('brand_id',$brand_id);
        }

        if($request->color){
            $find_color = Color::where('slug',$request->color)->first();
            if(!$find_color){
                return redirect('/')->with('error','Wrong color');
            }
            $color_id=$find_color->id;
            $product->WhereHas('color',function($q) use ($color_id){
                return $q->select('product_color.color_id',$color_id);
            });
        }

        if($request->search){
            $search = $request->search;
            $product->where('name','like','%search%');
        }



        $product = $product->paginate(2);
        return view('home',
    compact('product','category','color','brand')
    );
    }

    public function productDetail($slug){
        $product = Product::where('slug',$slug)->first();
        if(!$product){
            return redirect('/')->with('error' , 'product not found');
        }
        return view('product-detail',compact('product'));
    }

    public function makeReview()
    {
        ProductReview::create([
            'user_id' => auth()->id(),
            'product_id' => request()->product_id,
            'review' => request()->review,
        ]);

        $user_name = auth()->user()->name;
        $review = request()->review;
        return '
        <div class="crad border p-3">
        <small class="text-muted">' . $user_name . '</small>
        <br>
        <p class="p-3">
           ' . $review . '
        </p>
    </div>
        ';
    }

    public function editProfile()
    {
        return view('user-profile');
    }
}
