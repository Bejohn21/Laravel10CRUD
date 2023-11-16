<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;


class ProductController extends Controller
{
    public function index(){
        return view('products.index');
    }
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){

        //Validate data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif|max:10000'
        ]);

        // upload image
        // dd($request->all());
        $Imagename = time().'.'.$request->image->extension();
        $request->image->move(public_path("products"), $Imagename);
        
        
        $product = new product;
        $product->image=$Imagename;
        $product->name=$request->name;
        $product->description=$request->description;
       
        $product->save();
        return back()->withSuccess('Product created');
    }
}
