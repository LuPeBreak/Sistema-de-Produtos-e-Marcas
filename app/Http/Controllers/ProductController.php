<?php

namespace App\Http\Controllers;

use App\Product;
use App\Brand;
use Illuminate\Http\Request;
use Auth;
use File;


class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('product/product',compact('products'));

    }

    public function create()
    {
        $brands = Brand::all();
        return view('product/product_register',compact('brands'));
    }   

    public function store(Request $request)
    {
        //valida dados
        $validatedData = $request->validate([
            'name' => 'required|unique:products|max:15',
            'description' => 'required|max:30',
            'brand'=>'required',
            'image'=>'required|image',
        ]);
        //salvando img
        $file = $request->file('image');
        $extension=$file->getClientOriginalExtension();
        $imgname= $validatedData['name'].'.'.$extension;
        $path=public_path('/images');
        $file->move($path,$imgname);

            //procura pela marca informada
        $brand = Brand::findOrFail($request->brand);
            //salva de acordo com a marca informada
        $brand->products()->create([
            'name'=> $validatedData['name'],
            'description'=> $validatedData['description'],
            'user_id'=>Auth::user()->id,
            'imgsrc'=>"images/".$validatedData['name'].'.'.$extension,
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
        return view('product/product_register',compact(['brands','product']));
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
            //checagem de imagem    
            if($request->hasFile('image')){
                //salvando img
                File::delete($product->imgsrc);
                $file = $request->file('image');
                $extension=$file->getClientOriginalExtension();
                $imgname= $validatedData['name'].'.'.$file->getClientOriginalExtension();
                $path=public_path('/images');
                $file->move($path,$imgname);
            }

            $product->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'brand_id'=>$validatedData['brand'],
                'imgsrc'=>$request->hasFile('image')? 'images/'.$validatedData['name'].'.'.$extension:$product->imgsrc,
            ]);
    
            return redirect('/products');
        }
        return view('errors/unauthorized')->with('role', 'ADMINs ou o criador do produto');
    }
    
    public function destroy(Product $product)
    {
        File::delete($product->imgsrc);
        $product->delete();
        return redirect('products');
    }

}