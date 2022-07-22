<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::latest()->get();
        
        return view('admin.supplier.index',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image'=> 'required',
        ]);

        $file = $request->file('image');
        $file_name = uniqid().$file->getClientOriginalName();
        $file->move(public_path('/images'),$file_name);

        Supplier::create([
            'name'=>$request->name,
            'image'=> $file_name,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success','Supplier Created Success');
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
        $supplier = Supplier::where('id',$id)->first();
       
        return view('admin.supplier.edit',compact('supplier'));
        //upload
        
        

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

        $name = $request->name;
        $description = $request->description;
        $supplier =  Supplier::find($id);
       
       
        
        if($file = $request->file('image')){
           
            $file_name = $file->getClientOriginalName();
            //old image and DB old imgae delete
            File::delete(public_path('/images/'.$file_name));
            //new image store in DB
            $file->move(public_path('/images/'.$file_name));
        }else{
            $file_name = $supplier->first()->image;
        }
        $supplier->update([
            'name' => $name,
            'image' => $file_name,
            'description' => $description,
        ]);
        return redirect()->back()->with('update','update successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $delSuppler =  Supplier::where('id',$id);
       
       $file_name = $delSuppler->first()->image;
       
       File::delete(public_path('/images/'.$file_name));
        $delSuppler->delete();
        return redirect()->back()->with('delete','Supplier Deleted');
    }
}
