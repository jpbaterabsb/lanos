@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    <div class="box box-solid box-primary">
        <div class="box-header with-border">
            <h2>Clientes</h2>
        </div>
    </div>

    <div class="box">
        <form role="form" method="get" action="{{Request::root()}}/Cliente/filter" >
            <div class="box-header with-border">
                <h3>Filtro</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="endereco">Endereço:</label>
                            <input type="text" class="form-control" id="endereco" name="endereco">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id">Telefone:</label>
                            <input type="text" class="form-control" id="telefone" name="telefone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="endereco">Email:</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id">CPF:</label>
                            <input type="text" class="form-control cpf" id="cpf" name="cpf">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-8">
                            <div class="col-md-1">
                                <label>
                                    Satus:
                                </label>
                            </div>

                            <div class="col-md-2">
                                <input class="form-check-input" type="radio" name="status" id="ativo" value="1" checked>
                                <label class="form-check-label" for="ativo">
                                    Ativo
                                </label>
                            </div>
                            <div class="col-md-3">
                                <input class="form-check-input" type="radio" name="status" id="desativado" value="0">
                                <label class="form-check-label" for="desativado">
                                    Desativado
                                </label>
                            </div>
                            <div class="col-md-2">
                                <input class="form-check-input" type="radio" name="status" id="ambos" value="2">
                                <label class="form-check-label" for="ambos">
                                    Ambos
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <div class="box">
        <div class="box-header"></div>
        <div class="box-body">
            @if(Session::has('message'))
                <div class="alert alert-success">
                    <strong><span class="glyphicon glyphicon-ok"></span>{{  Session::get('message') }}</strong>
                </div>
            @endif

            @if(count($Clientes)>0)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Cpf</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1 ?>
                    @foreach($Clientes as $Cliente)
                        <tr>
                            <td>{{$i}} </td>
                            <td> <a href="{{Request::root()}}/Cliente/view-Cliente/{{$Cliente->id}}" > {{$Cliente->nome }}</a> </td>
                            <td>{{$Cliente->endereco}}</td>
                            <td>{{$Cliente->telefone}}</td>
                            <td>{{$Cliente->email}}</td>
                            <td>{{$Cliente->cpf}}</td>
                            <td>
                                <a href="{{Request::root()}}/Cliente/change-status-Cliente/{{$Cliente->id }}" > @if($Cliente->status==0) {{"Ativar"}}  @else {{"Desativar"}} @endif </a>
                                <a href="{{Request::root()}}/Cliente/edit-Cliente/{{$Cliente->id}}" >Editar</a>
                                {{--<a href="{{Request::root()}}/Cliente/delete-Cliente/{{$Cliente->id}}" onclick="return confirm('are you sure to delete')">Delete</a>--}}
                            </td>

                        </tr>
                        <?php $i++;  ?>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info" role="alert">
                    <strong>No Clientes Found!</strong>
                </div>
            @endif
        </div>
        <div class="box-footer"></div>
    </div>

@endsection

@section('js')
    <script src="{{asset('js/jquery.mask.js')}}"></script>
    <script src="{{asset('js/util.js')}}"></script>
@endsection