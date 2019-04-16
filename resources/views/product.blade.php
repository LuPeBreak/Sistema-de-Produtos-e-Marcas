@extends('layouts.app')

@section('content')
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<div class="container">
        <a class='btn-floating btn-small waves-effect waves-light green ml-auto' href="/products/create"><i class="fa fa-plus"></i></a>
    <div class="row justify-content-center">
        @foreach ($products as $product)
            <div class="col-md-4">
                <div class="row">
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-image">
                                <img src="images/sample-1.jpg">
                                <span class="card-title">{{$product->name}}</span>
                                <a class="btn-floating halfway-fab waves-effect waves-light blue"><i
                                        class="fa fa-edit"></i></a>
                            </div>
    
                            <div class="card-content">
                                Marca:{{$product->brand->name}}
                                <p>{{$product->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        

    </div>
</div>
@endsection
