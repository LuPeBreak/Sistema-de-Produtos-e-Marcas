@extends('layouts.app')

@section('content')
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<div class="container">
<div class="row">
        <a class='input-field btn-floating btn-small waves-effect waves-light green' href="{{route('products.create')}}"><i
            class="fa fa-plus"></i></a>
            <div class="col-md-10 ml-auto">
                    <form action="{{route('products.search')}}" method="GET" class="row">
        
                            <div class="input-field form-group">
                                <select class="form-control" name="brand" id="brand">
                                    <option value="">Todas as marcas</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}" 
                                        {{ !empty($search) && $search['brand_id'] == $brand->id? 'selected':''}}>
                                        {{$brand->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <div class="form-group col-md-6">
                                <input id="name" class="form-control" name="name" value="{{ !empty($search) ? $search['name']:''}}">
                            </div>
                    
                            <button class=' input-field btn-small col-md-2' type="submit"><i class='fa fa-search'></i></button>
                        </form>
                </div>
   
</div>
   

    <div class="row justify-content-center">
        @foreach ($products as $product)
        <div class="col-md-4">
            <div class="row">
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-image">
                            <img src="/{{$product->imgsrc != null ? $product->imgsrc: 'images/noimgavailable.png'}}">
                            <p class="card-title"><a aria-hidden="true"
                                    style='text-shadow: 1px 1px black'>{{$product->name}}</a></p>
                            <a href="{{route('products.edit',$product->id)}}"
                                class="{{  $product->user->id != Auth::user()->id && !Auth::user()->isAdmin()? 'disabled':''}} btn-floating halfway-fab waves-effect waves-light blue"><i
                                    class="fa fa-edit"></i></a>
                        </div>

                        <div class="card-content">
                            
                            <p>
                                Marca: {{$product->brand->name}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>
@endsection
