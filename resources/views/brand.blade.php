@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header row col-md-12">
                    <h6>Marcas</h6>
                    <a class='ml-auto' href="/brands/create"><i class="fa fa-plus"></i></a>
                </div>

                <div class="card-body">
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
                                                <a href="/brands/{{$brand->id}}/edit"><i class="fa fa-edit"></i></a>
                                                <a class='col-md-1' href=""><i class="fa fa-trash"></i></a>
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
@endsection
