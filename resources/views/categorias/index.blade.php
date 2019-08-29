@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    <div class="box box-solid box-primary">
        <div class="box-header"><h2>Categorias</h2></div>
    </div>

    <div class="box">
        <div class="box-header"></div>
        <div class="box-body"></div>
        <div class="box-footer"></div>
    </div>

    <div class="box">
        <div class="box-header with-border"></div>
        <div class="box-body">

            @if(Session::has('message'))
                <div class="alert alert-success">
                    <strong><span class="glyphicon glyphicon-ok"></span>{{  Session::get('message') }}</strong>
                </div>
            @endif

            @if(count($Categoriass)>0)
                <table id="table" class="table table-active table-bordered">
                    <thead>
                    <tr>
                        <th>SL No</th>
                        <th>nome</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1 ?>
                    @foreach($Categoriass as $Categorias)
                        <tr>
                            <td>{{$i}} </td>
                            <td> <a href="{{Request::root()}}/categorias/view/{{$Categorias->id}}" > {{$Categorias->nome }}</a> </td>

                            <td>
                                <a href="{{Request::root()}}/categorias/{{$Categorias->id }}/change-status" > @if($Categorias->status==0) {{"Ativar"}}  @else {{"Desativar"}} @endif </a>
                                <a href="{{Request::root()}}/categorias/{{$Categorias->id}}/edit" >Editar</a>
                                {{--<a href="{{Request::root()}}/categorias/delete-Categorias/{{$Categorias->id}}" onclick="return confirm('are you sure to delete')">Delete</a>--}}
                            </td>

                        </tr>
                        <?php $i++;  ?>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info" role="alert">
                    <strong>No Categoriass Found!</strong>
                </div>
            @endif

        </div>
        <div class="box-footer "></div>
    </div>
@endsection

@section('js')

    <script>
        $('#table').DataTable();
    </script>
@endsection