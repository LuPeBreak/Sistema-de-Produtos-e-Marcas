<?php

namespace App\Http\Controllers;

use App\Product;
use App\Brand;
use Illuminate\Http\Request;
use Auth;
use File;


class ProductController extends Controller
{
    //metodo para pesquisa de produtos
    public function search(Request $request){
        //brands para popular o select da pesquisa
        $brands= Brand::all();
        
        //pesquisa condicional de produtos
        if ($request->brand == null) {
            $products = Product::where('name', 'LIKE', '%'.$request->name.'%')->get();
        }else{
            $products = Product::where('brand_id',$request->brand)->where('name', 'LIKE', '%'.$request->name.'%')->get();
            
        };
        //retorna dados da pesquisa para melhora da UX
        $search = [
            'brand_id'=>$request->brand,
            'name'=>$request->name
        ];

        return view('product/product',compact(['products','brands','search']));
    }


    // METODOS RESOURCE

    public function index()
    {
        $brands= Brand::all();
        $products = Product::all();
        // dd($products[0]->imgsrc);
        return view('product/product',compact(['products','brands']));

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
            'description' => '',
            'brand'=>'required',
            'image'=>'',
        ]);
        
        //seta imgsrc como vazia
        $imgsrc=null;

        //verifica se ha uma img para ser carregada
        if($request->hasFile('image')){

        //salvando img
        $file = $request->file('image');
        $extension=$file->getClientOriginalExtension();
        $imgname= $validatedData['name'].'.'.$extension;
        $path=public_path('/images');
        $file->move($path,$imgname);   
        $imgsrc = "images/".$validatedData['name'].'.'.$extension;
        }    

        //procura pela marca informada
        $brand = Brand::findOrFail($request->brand);

        //salva de acordo com a marca informada
        $brand->products()->create([
            'name'=> $validatedData['name'],
            'description'=> $validatedData['description'],
            'user_id'=>Auth::user()->id,
            'imgsrc'=>$imgsrc,
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
        //condiçao para evitar updates por usuarios incorretos
        if(Auth::user()->id == $product->user->id || Auth::user()->type == 'admin'){
            $validatedData = $request->validate([
                'name' => 'required|unique:brands|max:30',
                'description' => 'required',
                'brand'=>'required',
            ]);
            //checagem de imagem para o ou nao update do arquivo    
            if($request->hasFile('image')){
                //salvando img
                File::delete($product->imgsrc);
                $file = $request->file('image');
                $extension=$file->getClientOriginalExtension();
                $imgname= $validatedData['name'].'.'.$file->getClientOriginalExtension();
                $path=public_path('/images');
                $file->move($path,$imgname);
            }
            //update de produto
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
        //deleta a imagem do produto evitando excesso de imgs desnecessarias
        File::delete($product->imgsrc);

        $product->delete();
        return redirect('products');
    }

}