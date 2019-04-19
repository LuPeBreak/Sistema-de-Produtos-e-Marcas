@extends('layouts.app')

@section('content')
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id='root'>
                <div class="card-header row col-md-12">
                    <h6>Marcas</h6>
                    <a class='btn-floating btn-small waves-effect waves-light green ml-auto'
                        href="{{route('brands.create')}}"><i class="fa fa-plus"></i></a>
                </div>

                <div class="card-body col-md-12">
                    <table id='datatable' class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                            <tr>
                                <td>{{$brand->name}}</td>
                                
                                <td class='row'>
                                    <a class='ml-auto waves-effect waves-teal btn-flat btn-small'
                                        href="/brands/{{$brand->id}}/edit"><i class="fa fa-edit"></i></a>
                                    <form action="{{route('brands.destroy',$brand->id)}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class='waves-effect waves-teal btn-flat btn-small' type='submit'><i
                                                class="fa fa-trash"></i></button>
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
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.4.0.min.js"
    integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').DataTable({
            "ordering": false,
            "info": false
        });
    });

</script>
@endsection
