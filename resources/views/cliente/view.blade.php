@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
        <ul class="list-group">
            <li class="list-group-item active">{{$Cliente->nome}}</li>
            <li class="list-group-item">Telefone: {{$Cliente->telefone}}</li>
            <li class="list-group-item">Email: {{$Cliente->email}}</li>
            <li class="list-group-item">Endereço: {{\App\Helper\ObjectHelper::formatEndereco($Cliente->endereco)}}</li>
        </ul>
@endsection