@extends('layouts.app')

@section('content')
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card" id='root'>
                <div class="card-header row col-md-12">
                    <h6>Marcas</h6>
                    <a class='btn-floating btn-small waves-effect waves-light green ml-auto' href="/brands/create"><i class="fa fa-plus"></i></a>
                </div>

                <div class="card-body" >
                        <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Descriçao</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{$brand->name}}</td>
                                            <td>{{$brand->description}}</td>
                                            <td>
                                                <a class='waves-effect waves-teal btn-flat btn-small' href="/brands/{{$brand->id}}/edit"><i class="fa fa-edit"></i></a>
                                                <button class='waves-effect waves-teal btn-flat btn-small' v-on:click='deleteBrand'><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>  
                                    @endforeach
                                    
                                </tbody>
                                
                            </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
new Vue({
    el:'#root',
    methods: {
        deleteBrand(){
            alert('oi');
        }
    },
});

</script>
@endsection
