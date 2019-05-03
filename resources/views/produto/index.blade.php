@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')

    <h2>Manage Produto</h2>

    @if(Session::has('message'))
        <div class="alert alert-success">
            <strong><span class="glyphicon glyphicon-ok"></span>{{  Session::get('message') }}</strong>
        </div>
    @endif

    @if(count($Produtos)>0)
        <table class="table table-hover">
            <thead>
            <tr>
                <th>SL No</th>
                <th>descricao</th>
                <th>quantidade</th>
                <th>valor</th>
                <th>Categoria</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1 ?>
            @foreach($Produtos as $Produto)
                <tr>
                    <td>{{$i}} </td>
                    <td> <a href="{{Request::root()}}/Produto/view-Produto/{{$Produto->id}}" > {{$Produto->descricao }}</a> </td>
                    <td>{{$Produto->quantidade}}</td>
                    <td>{{$Produto->valor}}</td>
                    <td>{{$Produto->Categoria->nome}}</td>

                    <td>
                        <a href="{{Request::root()}}/Produto/change-status-Produto/{{$Produto->id }}" > @if($Produto->status==0) {{"Activate"}}  @else {{"Dectivate"}} @endif </a>
                        <a href="{{Request::root()}}/Produto/edit-Produto/{{$Produto->id}}" >Edit</a>
                        <a href="{{Request::root()}}/Produto/delete-Produto/{{$Produto->id}}" onclick="return confirm('are you sure to delete')">Delete</a>
                    </td>

                </tr>
                <?php $i++;  ?>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info" role="alert">
            <strong>No Produtos Found!</strong>
        </div>
    @endif
@endsection