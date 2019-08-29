@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')

    @if(Session::has('message'))
        <div class="alert alert-success">
            <strong><span class="glyphicon glyphicon-ok"></span>{{  Session::get('message') }}</strong>
        </div>
    @endif
    <div class="box box-primary box-solid">
        <div class="box-header">
            <h2>Produtos</h2>
        </div>
    </div>

    <div class="box">
        <form role="form" method="get" action="produto/filter" >
        <div class="box-body with-border">
            <h3>Filtro</h3>
        </div>
        <div class="box-header">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id">nome:</label>
                        <input type="text" class="form-control" id="descricao" name="descricao">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cliente">Categorias:</label>
                        <select id="categoria" name="categoria" class="form-control select2">
                            <option></option>
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                            @endforeach
                        </select>
                    </div>
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
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
    </div>
    <div class="box">
        <div class="box-body"></div>
        <div class="box-body">
            @if(count($Produtos)>0)
                <table id="table" class="table table-hover">
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
                            <td> <a href="produto/{{$Produto->id}}/view" > {{$Produto->descricao }}</a> </td>
                            <td>{{$Produto->quantidade}}</td>
                            <td>{{\App\Helper\ObjectHelper::toMoneyFormat($Produto->valor)}}</td>
                            <td>{{$Produto->Categoria->nome}}</td>

                            <td>
                                <a href="/produto/{{$Produto->id }}/change-status" > @if($Produto->status==0) {{"Ativar"}}  @else {{"Desativar"}} @endif </a>
                                <a href="/produto/{{$Produto->id}}/edit" >Editar</a>
{{--                                <a href="{{Request::root()}}/Produto/delete-Produto/{{$Produto->id}}" onclick="return confirm('are you sure to delete')">Delete</a>--}}
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
        </div>
        <div class="box-footer">
        </div>
    </div>
@endsection

@section('js')
<script src="{{asset('js/select2.js')}}"></script>
<script>
    $('#table').DataTable();
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Selecione um cliente",
            allowClear: true,
        });
    });
</script>
@endsection