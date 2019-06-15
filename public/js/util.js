
$(document).ready(function($){
    $("#telefone").mask("(00) 0000-0000");

    $("#tipo").on('change',function () {
        if ( $("#tipo").val() == 'CELULAR')
            $("#telefone").mask("(00) 0 0000-0000");
        else
            $("#telefone").mask("(00) 0000-0000");
    });

    $("#cep").mask("00.000-000");
    $('.date').mask('00/00/0000');
    $('.time').mask('00:00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
    $('.cep').mask('00000-000');
    $('.phone').mask('0000-0000');
    $('.phone_with_ddd').mask('(00) 0000-0000');
    $('.phone_us').mask('(000) 000-0000');
    $('.mixed').mask('AAA 000-S0S');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.money2').mask("#.##0,00", {reverse: true});
    $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
        translation: {
            'Z': {
                pattern: /[0-9]/, optional: true
            }
        }
    });
    $('.ip_address').mask('099.099.099.099');
    $('.percent').mask('##0,00%', {reverse: true});
    $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
    $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
    $('.fallback').mask("00r00r0000", {
        translation: {
            'r': {
                pattern: /[\/]/,
                fallback: '/'
            },
            placeholder: "__/__/____"
        }
    });
    $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});








    $('.select2UF').select2({
        placeholder: "Selecione um UF"
    });

});


function mascaraValor(valor) {
        valor = valor.toString().replace(/\D/g,"");
        // console.log(valor)
        valor = valor.toString().replace(/(\d)(\d{8})$/,"$1.$2");
        // console.log(valor)
        valor = valor.toString().replace(/(\d)(\d{5})$/,"$1.$2");
        // console.log(valor)
        valor = valor.toString().replace(/(\d)(\d{2})$/,"$1,$2");
        return valor;

}

function endIndexOf(target,valor) {
    return valor.lastIndexOf(target)+target.length;
}

String.prototype.replaceAll = String.prototype.replaceAll || function(needle, replacement) {
    return this.split(needle).join(replacement);
};

function toAmericanMoney(value) {
    value =value.replaceAll(".","");
    value = value.replace(",",".");
    return parseFloat(value).toFixed(2);
}

function getDatas(dataFromView) {
    let datas = [];
    for (let stringData in dataFromView){
        let partesData = data.split('/');
        let data = new Date(partesData[2], partesData[1] - 1, partesData[0]);
        datas.push(data);
    }
    return datas;
}