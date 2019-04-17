<?php

namespace App\Http\Controllers;

use App\Product;
use App\Brand;
use Illuminate\Http\Request;
use Auth;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('product',compact('products'));

    }

    public function create()
    {
        $brands = Brand::all();
        return view('product_register',compact('brands'));
    }

    public function store(Request $request)
    {
        //valida dados
        $validatedData = $request->validate([
            'name' => 'required|unique:products|max:15',
            'description' => 'required|max:30',
            'brand'=>'required'
        ]);
            //procura pela marca informada
        $brand = Brand::findOrFail($request->brand);
            //salva de acordo com a marca informada
        $brand->products()->create([
            'name'=> $validatedData['name'],
            'description'=> $validatedData['description'],
            'user_id'=>Auth::user()->id,
        ]);
        return redirect('/products');
    }

 
    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        if(Auth::user()->id == $product->user->id || Auth::user()->type == 'admin'){
        $brands = Brand::all();
        return view('product_register',compact(['brands','product']));
        }
        return view('errors/unauthorized')->with('role', 'ADMINs ou o criador do produto');
    }

    public function update(Request $request, Product $product)
    {
        if(Auth::user()->id == $product->user->id || Auth::user()->type == 'admin'){
            $validatedData = $request->validate([
                'name' => 'required|unique:brands|max:30',
                'description' => 'required',
                'brand'=>'required',
            ]);
    
            $product->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'brand_id'=>$validatedData['brand'],
            ]);
    
            return redirect('/products');
        }
        return view('errors/unauthorized')->with('role', 'ADMINs ou o criador do produto');
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('products');
    }

}