@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')

<ul class="list-group">
    <li class="list-group-item active">{{$Produto->descricao}}</li>
    <li class="list-group-item">Quantidade: {{$Produto->quantidade}}</li>
    <li class="list-group-item">Valor: {{$Produto->valor}}</li>
    <li class="list-group-item">Categoria: {{$Produto->Categoria->nome}}</li>
</ul>

@endsection
