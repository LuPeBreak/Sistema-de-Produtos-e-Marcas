@extends('layouts.app')

@section('content')
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        @foreach ($products as $product)
            <div class="col-md-4">
                <div class="row">
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-image">
                                <img src="images/sample-1.jpg">
                                <span class="card-title">Card Title</span>
                                <a class="btn-floating halfway-fab waves-effect waves-light blue"><i
                                        class="fa fa-edit"></i></a>
                            </div>
    
                            <div class="card-content">
                                Marca:
                                <p>I am a very simple card. I am good at containing small bits of information. I am
                                    convenient because I require little markup to use effectively.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        

    </div>
</div>
@endsection
