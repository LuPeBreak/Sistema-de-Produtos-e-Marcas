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
                    <a class='btn-floating btn-small waves-effect waves-light green ml-auto' href="{{route('brands.create')}}"><i class="fa fa-plus"></i></a>
                </div>

                <div class="card-body row col-md-12">
                        <table  class="display" style="width:100%">
                                <thead style="width:100%">
                                    <tr class='row'>
                                        <th class='col-md-4'>Nome</th>
                                        <th class='col-md-6'>Descriçao</th>
                                        <th class='col-md-2'></th>
                                    </tr>
                                </thead style="width:100%">
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr class='row'>
                                            <td class='col-md-4'>{{$brand->name}}</td>
                                            <td class='col-md-6'> {{$brand->description }} </td>
                                            <td class='col-md-2' >
                                                <a class='waves-effect waves-teal btn-flat btn-small' href="/brands/{{$brand->id}}/edit"><i class="fa fa-edit"></i></a>

                                                <form action="{{route('brands.destroy',$brand->id)}}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class='waves-effect waves-teal btn-flat btn-small' type='submit'><i class="fa fa-trash"></i></button>
                                               </form>

                                                
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
