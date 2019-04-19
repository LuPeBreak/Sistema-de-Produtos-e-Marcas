<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use File;
class BrandController extends Controller
{
    public function index()
    {
        $brands= Brand::all();
        return view('brand/brand',compact('brands'));
    }

    public function create()
    {
        return view('brand/brand_register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:brands|max:15',
            'description' => 'required|max:30',
        ]);
        Brand::create($validatedData);
        return redirect('/brands');
    }

    public function show(Brand $brand)
    {
        //
    }

    public function edit(Brand $brand)
    {
        return view('brand/brand_register',compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:brands|max:30',
            'description' => 'required',
        ]);
        $brand->update($validatedData);
        return redirect('/brands');
    }

    public function destroy(Brand $brand)
    {
        //deleta imagens de cada produto da brand deletada
        foreach ($brand->products as $product) {
            File::delete($product->imgsrc);
        }

        //deleta produtos associados a brand
        $brand->products()->delete();

        $brand->delete();
        return redirect('/brands');
    }
}
