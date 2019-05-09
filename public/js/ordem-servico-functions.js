function subimeter(){

    var table = $('#myTable').DataTable();
    var lista = [];

    table.rows().data().each(function (row) {
        let object = { id : `${row[0]}`,
            valor : `${row[2]}`}
        lista.push(object);
    });

    $('#listaProduto').val(JSON.stringify(lista));

    $("#cadastro").submit();
}




//autcomplete produto
$('#produto').autocomplete({
    serviceUrl: '../Produto/nome',
    onSelect: function (suggestion) {
        $('#produtoId').val(suggestion.id);
        $('#produtoObject').val(JSON.stringify(suggestion));
    }
});

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

        calcularTotal();

        //remove lin
    });


});