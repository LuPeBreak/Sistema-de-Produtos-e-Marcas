@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Marca') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ empty($brand)? route('brands.store') : route('brands.update',['id' => $brand->id])  }}">
                            @csrf
                           @if (!empty($brand))
                            @method('PUT')
                           @endif
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ !empty($brand) ? $brand->name:''}}" required autofocus>
    
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descriçao') }}</label>
    
                                <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required
                                    >{{ !empty($brand) ? $brand->description:''}}
                                </textarea>
    
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

    
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ !empty($brand) ? 'Editar':'Cadastrar' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
