@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Produto') }}</div>

                <div class="card-body">
                    <div class="ml-auto">
                        @if (!empty($product))
                        <form action="{{route('products.destroy',$product->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <button class='btn btn-danger btn-sm' type="submit"><i class='fa fa-trash'></i></button>
                        </form>
                        @endif
                    </div>
                    <form method="POST" enctype="multipart/form-data"action="{{ empty($product)? route('products.store') : route('products.update',['id' => $product->id])  }}">
                        @csrf
                        @if (!empty($product))
                        @method('PUT')
                        @endif
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" value="{{ !empty($product) ? $product->name:''}}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="brand" class="col-md-4 col-form-label text-md-right">{{ __('Descriçao') }}</label>

                            <div class="col-md-6">
                                <textarea id="brand" type="text"
                                    class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                    name="description" required>{{ !empty($product) ? $product->description:''}}
                                </textarea>

                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="brand" class="col-md-4 col-form-label text-md-right">Marca</label>
                            <div class="col-md-6">
                                <select class="form-control" name="brand" id="brand" required>
                                    @foreach ($brands as $brand)
                                    <option class='{{ $errors->has('brand') ? ' is-invalid' : '' }}' value="{{$brand->id}}" {{ !empty($product) && $product->brand_id == $brand->id? 'selected':''}}>
                                        {{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('brand'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('brand') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">imagem (PNG)</label>
                                <div class="col-md-6">
                                        <input {{empty($product)?'required':''}} type="file" id="image" name="image" class='{{ $errors->has('brand') ? ' is-invalid' : '' }}' accept="image/png">
                                </div>
                                @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" {{ empty($brand) ? 'disabled':'' }} class="btn btn-primary">
                                    {{ !empty($product) ? 'Editar':'Cadastrar' }}
                                </button>

                            </div>
                        </div>

                        


                    </form>
                    @if (empty($brand))
                    <br>
                    <div class='row mb-0'>
                        <span class=' offset-md-4 alert alert-danger' role="alert">
                            <strong>Nao existem marcas para cadastrar o produto</strong>
                        </span>
                    </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
