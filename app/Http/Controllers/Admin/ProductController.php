<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAddTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function db(){
        Brand::create([
            'slug' =>uniqid(). Str::slug('iphone'),
            'name' => 'iphone'
        ]);
        Brand::create([
            'slug' =>uniqid(). Str::slug('samsung'),
            'name' => 'samsung'
        ]);
     }

    public function index()
    {
        $products = Product::all();
        return view('admin.product.index',compact('products'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $supplier = Supplier::all();
        $brand = Brand::all();
        $category = Category::all();
        $color = Color::all();
        return view('admin.product.create',compact('supplier','brand','category','color'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        //image upload
        $file = $request->file('image');
        $file_name =uniqid(). $file->getClientOriginalName();
        $file->move(public_path('/images'),$file_name);
        // $file->move(public_path('/images/'.$file_name));
        //product store
        $name = $request->name;
       
        $product = Product::create([
            'supplier_id' => $request->supplier_id,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' =>uniqid(). Str::slug($name),
            'image' => $file_name,
            'description' => $request->description,
            'total_quantity'=> $request->total_quantity,
            'sell_price'=> $request->sell_price,
            'buy_price'=> $request->buy_price, 
        ]);
        //add product transition

        ProductAddTransaction::create([
            'product_id' => $product->id,
            'supplier_id' => $request->supplier_id,
            'total_quantity' => $request->total_quantity,
            'buy_date' => date('Y-m-d'),
            'description' => $request->tran_description,

        ]);

        //pivot
        $product = Product::find($product->id);
        $product->color()->sync($request->color_id);
        return redirect()->back()->with('success','Product Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::where('id',$id)->with('supplier','brand','category','color')->first();
        
        $supplier = Supplier::all();
        $brand = Brand::all();
        $category = Category::all();
        $color = Color::all();
        return view('admin.product.edit',compact('product','supplier','brand','category','color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product = Product::where('id',$id);
        $product_id = $product->first()->id;

        if($file = $request->file('image')){
            $file_name = $file->getClientOriginalName();
            //old image and DB old imgae delete
            File::delete(public_path('/images/'.$file_name));
            //new image store in DB
            $file->move(public_path('/images/'.$file_name));
        }else{
            $file_name = $product->first()->image;
        }
        
        $product->update([
            'supplier_id' => $request->supplier_id,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' =>uniqid(). Str::slug($request->name),
            'image' => $file_name,
            'description' => $request->description,
            
            'sell_price'=> $request->sell_price,
            
        ]);

        $product = Product::find($product_id);
        $product->color()->sync($request->color_id);
        return redirect()->back()->with('success','Product Updated');
        
        //db image name
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find_product = Product::where('id',$id);
        //images / delete
        File::delete(public_path('/images/'.$find_product->first()->image));
        //
        $find_product->delete();
        return redirect()->back()->with('delete','Deleted Product');
    }

    public function showProductAdd($id){
        $product = Product::find($id);
        $supplier = Supplier::all();
        return view('admin.product.create-add',compact('product','supplier'));
    }

    public function postProductAdd($id){
      
        ProductAddTransaction::create([
            'product_id' => $id,
            'supplier_id' => request()->supplier_id,
            // 'buy_price' => request()->buy_price,
            'total_quantity' => request()->total_quantity,
            'buy_date' => date('Y-m-d'),
            'description' => request()->description,
        ]);

        Product::where('id',$id)->update([
            'total_quantity' => DB::raw('total_quantity+'.request()->total_quantity),
        ]);
        return redirect()->back()->with('success',request()->total_quantity.'Added');
    }

    public function showProductAddTran(){
        $transaction =  ProductAddTransaction::latest()
        ->with('product','supplier')
        ->paginate(10);
        return view('admin.product.product-add-tran',compact('transaction'));
    }
}
