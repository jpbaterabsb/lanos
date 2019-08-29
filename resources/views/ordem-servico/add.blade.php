@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')


@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box box-solid box-primary">
        <div class="box-header">
            <h2>Add OrdemServico</h2>
        </div>
        <div class="box-body">
            <form id="cadastro" role="form" method="post" action="/ordem-servico" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="cliente">Cliente:</label>

                    <select class="form-control select2" id="cliente" name="cliente">
                        @foreach($clientes as $cliente)
                            <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="produto">Produto:</label>
                    <input type="text" class="form-control" id="produto" name="produto">
                    <input type="hidden" id="produtoId" name="produtoId">
                    <input type="hidden" id="produtoObject" name="produtoObject">
                    <input type="hidden" id="listaProduto" name="listaProduto">
                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-primary" id="btn">Adicionar</button>
                </div>

                <table class="table table-striped table-bordered" id="myTable">
                    <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Valor</th>
                        {{--<th scope="col">Desconto</th>--}}
                        <th scope="col">Acap</th>
                    </tr>
                    </thead>


                    <tfoot>
                    <tr>
                        <th colspan="3" style="text-align:right">Total:</th>
                        <th id="total"></th>
                    </tr>
                    </tfoot>
                </table>

                <div class="form-group">
                    <label for="descricao">Descricao:</label>
                    <textarea rows="3" placeholder="Opicional" class="form-control" id="descricao" name="descricao"></textarea>
                </div>
            </form>
        </div>

        <div class="box-footer">
            <button type="button" id="salvar" class="btn btn-primary" onclick="subimeter()">Salvar</button>
        </div>
    </div>
@endsection

@section('css')
    <link href="{{asset('css/jquery.autocomplete.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
@endsection

@section('js')
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jquery.mask.js')}}"></script>
<script src="{{asset('js/jquery.autocomplete.js')}}"></script>
<script src="{{asset('js/util.js')}}"></script>
<script src="{{asset('js/select2.js')}}"></script>
<script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>


<script>

function subimeter(){

    var table = $('#myTable').DataTable();
    var lista = [];

    table.rows().data().each(function (row) {
        let object = { id : `${row[0]}`,
            valor : `${row[2]}`};
        lista.push(object);
    });

    $('#listaProduto').val(JSON.stringify(lista));
    $("#cadastro").submit();
}

        //autcomplete produto
$('#produto').autocomplete({
    serviceUrl: '../produto/nome',
    onSelect: function (suggestion) {
        $('#produtoId').val(suggestion.id);
        $('#produtoObject').val(JSON.stringify(suggestion));
    }
});

$(document).ready(function ($) {
    $("#salvar").prop('disabled',true);
    var table = $('#myTable').DataTable();

    $('.select2').select2({
        placeholder: "Selecione um cliente",
        allowClear: true,
    });

    $('input.form-control.input-sm').on('keyup', function () {

        table.search(this.value).draw();
    });

    function calcularTotal(){
        if(table.data().count() >= 1){
            $('#total').text('R$' + mascaraValor
            (
                // calcular total de acordo com a coluna
                parseFloat(
                    table
                        .column(2)
                        .data()
                        .reduce(function (a, b) {
                            return parseFloat(a) + parseFloat(b);
                        })
                ).toFixed(2)
            )
            );

        }else{
            $('#total').text('R$' + mascaraValor("0,00"));
        }

    }



    $('#myTable tbody').on('click', '.remove', function () {
        table
            .row($(this).parents('tr'))
            .remove()
            .draw();

        console.log(table.row().count());
        if(!table.row().count()){
            $("#salvar").prop('disabled',true);
        }
        calcularTotal();

    });

    $('#myTable tbody').on('click', '.alterar', function () {

        botao = $(this);
        table.cell($(this).parents('td').prev()).data(
            `<input type="number" min="0.00" max="10000.00" step="0.01" id='desconto${produto.id}' name='desconto${produto.id}' value='${$(this).parents('td').prev().text()}' class='money'>
             <button type="button"><i class="fa fa-fw fa-remove"></i></button>
             <button type="button"><i class="fa fa-check"></i></button>
            <input class="valor-antigo" value="${$(this).parents('td').prev().text()}" type="hidden">`
        );

        botao.prop('disabled',true);
        $('#salvar').prop('disabled',true);

        $('.fa-check').click(function (event) {
            let valor = $(this).parents('button').prev().prev().val();
            table.cell($(this).parents('td')).data(parseFloat(valor).toFixed(2));
            calcularTotal();
            botao.prop('disabled',false);
            $('#salvar').prop('disabled',false);
        });

        $('.fa-remove').click(function () {
            let valor = $(this).parents('td').find('.valor-antigo').val();
            table.cell($(this).parents('td')).data(parseFloat(valor).toFixed(2));
            calcularTotal();
            botao.prop('disabled',false);
            $('#salvar').prop('disabled',false);
        });

    });


    $("#btn").click(function () {
        var produto = JSON.parse($('#produtoObject').val());
        table.row.add([
            produto.id, produto.value,
            produto.valor,
            `<button type='button' class='btn btn-primary alterar' name="alterar">Alterar Valor</button>
             <button name='remove' type='button' class='btn btn-primary remove'>Remover</button>`
        ]).draw(false);
        $("#salvar").prop('disabled',false);
        calcularTotal();
    });
});

</script>
@endsection