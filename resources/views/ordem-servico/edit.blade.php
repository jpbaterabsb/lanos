@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
    <script src="{{asset('js/jquery.autocomplete.js')}}"></script>
    <script src="{{asset('js/util.js')}}"></script>
    <link href="{{asset('css/jquery.autocomplete.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <div class="box">
        <div class="box-header"><h2>Update OrdemServico</h2></div>
        <div class="box-body">
            <form id="editar" role="form" method="post" action="/ordem-servico/edit" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" value="<?php echo $OrdemServico->id ?>"   name="OrdemServico_id">
                <div class="form-group">
                    <label for="cliente">Cliente:</label>
                    <select class="form-control" id="cliente" name="cliente">
                        @foreach($clientes as $c)
                            <option @if($c->id == $OrdemServico->cliente->id) selected="selected" @endif value="{{$c->id}}">{{$c->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="produto">Produto:</label>
                    <input type="text" class="form-control" id="produto" name="produto">
                    <input type="hidden" id="produtoId" name="produtoId">
                    <input type="hidden" id="produtoObject" name="produtoObject">
                    <input type="hidden" id="listaProduto" name="listaProduto" value="{{$listaProduto}}">
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
                    <textarea rows="3" placeholder="opcional" class="form-control" id="descricao" name="descricao">{{ $OrdemServico->descricao }}
                    </textarea>
                </div>
                <button type="button" id="salvar" class="btn btn-primary" onclick="subimeter()">Salvar</button>
            </form>
        </div>
    </div>


    <script>
        function subimeter(){

            var table = $('#myTable').DataTable();
            var lista = [];

             // console.log($($('#myTable tbody tr:eq(0) td:eq(3) #opid')[0]).val());

            table.rows().data().each(function (row) {
                let object = { id : `${row[0]}`,
                    valor : `${row[2]}`,
                    opid : `${$($(row[3])[0]).val()}`}
                lista.push(object);
            });

            console.log(lista)

            $('#listaProduto').val(JSON.stringify(lista));

            $("#editar").submit();
        }




        //autcomplete produto
        $('#produto').autocomplete({
            serviceUrl: '../../Produto/nome',
            onSelect: function (suggestion) {
                $('#produtoId').val(suggestion.id);
                $('#produtoObject').val(JSON.stringify(suggestion));
            }
        });

        $(document).ready(function ($) {

            var table = $('#myTable').DataTable();
            var listaProduto = JSON.parse($('#listaProduto').val());
            $('input.form-control.input-sm').on('keyup', function () {

                table.search(this.value).draw();
            });

            listaProduto.forEach(function (produto) {
                table.row.add([
                    produto.pid,
                    produto.descricao,
                    produto.valor_venda,
                    `
                     <input type='hidden' id='opid' name='opid' value='${produto.opid}'/>
                     <button type='button' class='btn btn-primary alterar' name="alterar">Alterar Valor</button>
                     <button name='remove' type='button' class='btn btn-primary remove'>Remover</button>`
                ]).draw(false);
            });

            calcularTotal();

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

                if(!table.row().count()){
                    $("#salvar").prop('disabled',true);
                }z
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

                //remove lin
            });


        });
    </script>
@endsection