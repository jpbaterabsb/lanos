@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    <h2>Manage Categorias</h2>

    @if(Session::has('message'))
        <div class="alert alert-success">
            <strong><span class="glyphicon glyphicon-ok"></span>{{  Session::get('message') }}</strong>
        </div>
    @endif

    @if(count($Categoriass)>0)
        <table class="table table-hover">
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
                    <td> <a href="{{Request::root()}}/Categorias/view-Categorias/{{$Categorias->id}}" > {{$Categorias->nome }}</a> </td>

                    <td>
                        <a href="{{Request::root()}}/Categorias/change-status-Categorias/{{$Categorias->id }}" > @if($Categorias->status==0) {{"Activate"}}  @else {{"Dectivate"}} @endif </a>
                        <a href="{{Request::root()}}/Categorias/edit-Categorias/{{$Categorias->id}}" >Edit</a>
                        <a href="{{Request::root()}}/Categorias/delete-Categorias/{{$Categorias->id}}" onclick="return confirm('are you sure to delete')">Delete</a>
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
@endsection