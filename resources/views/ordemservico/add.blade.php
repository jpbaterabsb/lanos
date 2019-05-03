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

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h2>Add OrdemServico</h2>
    <form role="form" method="post" action="{{Request::root()}}/OrdemServico/add-OrdemServico-post" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="descricao">Descricao:</label>
            <input type="text" class="form-control" id="descricao" name="descricao">
        </div>
        <div class="form-group">
            <label for="cliente">Cliente:</label>

            <select class="form-control" id="cliente" name="cliente">
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
                <th scope="col">Desconto</th>
                <th scope="col">Acap</th>
            </tr>
            </thead>


            <tfoot>
            <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th id="total"></th>
            </tr>
            </tfoot>
        </table>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    <script>

        //autcomplete produto
        $('#produto').autocomplete({
            serviceUrl: '../Produto/nome',
            onSelect: function (suggestion) {
                $('#produtoId').val(suggestion.id);
                $('#produtoObject').val(JSON.stringify(suggestion));
            }
        });
        // $('#cliente').autocomplete({
        //     serviceUrl: '../Cliente/nome',
        //     onSelect: function (suggestion) {
        //         $('#clienteId').val(suggestion.id)
        //     }
        // });

        $(document).ready(function ($) {

            var table = $('#myTable').DataTable();


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

                    console.log(table.column(2).data())

                }else{
                    $('#total').text('R$' + mascaraValor("0,00"));
                }

            }



            $('#myTable tbody').on('click', '.remove', function () {
                table
                    .row($(this).parents('tr'))
                    .remove()
                    .draw();

                calcularTotal();

            });

            $('#myTable tbody').on('click', '.descontar', function () {
                let valor  = parseFloat($(this).parent().prev().text());
                let desconto = parseFloat($(this).prev().val());

                if (desconto > valor) {
                    alert("Desconto Maior que valor principal")
                }else{
                    $(this).parent().prev().text((valor - desconto).toFixed(2));
                    $(this).prop("disabled",true);
                    calcularTotal();
                }
            });




            $("#btn").click(function () {

                var produto = JSON.parse($('#produtoObject').val());

                table.row.add([
                    produto.id, produto.value, produto.valor,
                   `<input type="number" min="0.00" max="10000.00" step="0.01" id='desconto${produto.id}' name='desconto${produto.id}' class='money'>
                    <button type='button' class='btn btn-primary descontar' name="descontar">Descontar</button>`,
                    "<button name='remove' type='button' class='btn btn-primary remove'>Remover</button>"
                ]).draw(false);

                calcularTotal();

            //remove lin





            $('#descontar').click( function () {
                let total = table
                    .column(2)
                    .data();

                if (total.length != 0) {
                    total =   total.reduce(function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }).toFixed(2);
                }else{
                    total = 0.00;
                }


                let desconto = toAmericanMoney($('#desconto').val());

                if (parseFloat(desconto) > parseFloat(total)){
                    alert("O desconto nao pode ser maior que o valor total");
                    return
                }

                $('#total').text('Total R$ ' +  mascaraValor((total - desconto).toFixed(2 )));
            });
        })});

    </script>
@endsection
