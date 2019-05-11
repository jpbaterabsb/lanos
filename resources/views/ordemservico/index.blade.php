@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success">
            <strong><span class="glyphicon glyphicon-ok"></span>{{  Session::get('message') }}</strong>
        </div>
    @endif
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h2>Ordens de Serviço</h2>
        </div>
    </div>

    <div class="box">
        <form id="filtrar" role="form" method="get" action="{{Request::root()}}/OrdemServico/filter" >
            <div class="box-header with-border"><h3>Filtro</h3></div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id">Numero da ordem de servico:</label>
                            <input type="text" class="form-control" id="id" name="id">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cliente">Cliente:</label>
                            <select id="cliente" name="cliente" class="form-control js-example-basic-single">
                                <option></option>
                                @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="cliente">Deseja utilizar data:</label>
                            <input type="checkbox" id="isdata" aria-label="Checkbox for following text input">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" id="data-emissao">
                    </div>
                    <div class="col-md-6">

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
                                <input class="form-check-input" type="radio" name="status" id="ativo" value="0" checked>
                                <label class="form-check-label" for="ativo">
                                    Aberto
                                </label>
                            </div>
                            <div class="col-md-3">
                                <input class="form-check-input" type="radio" name="status" id="desativado" value="1">
                                <label class="form-check-label" for="desativado">
                                    Fechado
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
                <button type="submit" id="salvar" class="btn btn-primary" onsubmit="subimeter()">Filtrar</button>
            </div>
        </form>
    </div>

    <div class="box">
        <div class="box-header with-border"></div>
        <div class="box-body">

            @if(count($OrdemServicos)>0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Numero OS</th>
                        <th>descricao</th>
                        <th>Data de Emissão</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1 ?>
                    @foreach($OrdemServicos as $OrdemServico)
                        <tr>
                            <td>{{$i}} </td>
                            <td> <a href="{{Request::root()}}/OrdemServico/view-OrdemServico/{{$OrdemServico->id}}" > {{$OrdemServico->id }}</a> </td>
                            <td>{{$OrdemServico->descricao}}</td>
                            <td>{{$OrdemServico->created_at->format('d/m/Y')}}</td>

                            <td>
                                <a href="{{Request::root()}}/OrdemServico/change-status-OrdemServico/{{$OrdemServico->id }}" > @if($OrdemServico->status==0) {{"Fechar"}}  @else {{"Abrir"}} @endif </a>
                                <a href="{{Request::root()}}/OrdemServico/edit-OrdemServico/{{$OrdemServico->id}}" >Editar</a>
                                <a href="{{Request::root()}}/OrdemServico/pdf/{{$OrdemServico->id}}" >Gerar PDF</a>
                                {{--<a href="{{Request::root()}}/OrdemServico/delete-OrdemServico/{{$OrdemServico->id}}" onclick="return confirm('are you sure to delete')">Delete</a>--}}
                            </td>

                        </tr>
                        <?php $i++;  ?>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info" role="alert">
                    <strong>No OrdemServicos Found!</strong>
                </div>
            @endif
        </div>
        <div class="box-footer"></div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/daterangepicker.css')}}">
@endsection

@section('js')

    <script src="{{asset('js/select2.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/daterangepicker.js')}}"></script>
    <script src="{{asset('js/util.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: "Selecione um cliente",
                allowClear: true,
            });

            $('#isdata').change(function () {
                if (this.checked){
                    $("#data-emissao").append(`
                <label for="reservationtime">Data de emissão:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="reservationtime" name="reservationtime">
                </div>
            `);
                    $('#reservationtime').daterangepicker({
                        autoUpdateInput: true,
                        locale: {
                            cancelLabel: 'Clear',
                            dateonly:true
                        }
                    });

                    $('#reservationtime').on('apply.daterangepicker', function(ev, picker) {
                        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                    });

                    $('#reservationtime').on('cancel.daterangepicker', function(ev, picker) {
                        $(this).val('');
                    });

                }else{
                    $("#data-emissao").empty();
                }
            });

        });
    </script>

@endsection