@extends('adminlte::page')

@section('title', 'Lano\'s Informatica')


@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Faturamento</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <!-- Apply any bg-* class to to the info-box to color it -->
                    <div class="info-box bg-green-gradient">
                        <span class="info-box-icon"><i class="fa fa-money"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Faturamento Diário</span>
                            <span class="info-box-number">{{\App\Helper\ObjectHelper::toMoneyFormat( !empty($faturamentoDiario) ? $faturamentoDiario[0]->valor : number_format(0,2))}}</span>
                            <!-- The progress section is optional -->
                            <div class="progress">
                                <div class="progress-bar" style="width: {{$porcentagemDoDiaDoMes}}%"></div>
                            </div>
                            <span class="progress-description">
                                {{$diaDeHoje}}º dia de {{$ultimoDiaDoMes}} dias
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>

                <div class="col-md-4">
                    <!-- Apply any bg-* class to to the info-box to color it -->
                    <div class="info-box bg-yellow-gradient">
                        <span class="info-box-icon"><i class="fa fa-money"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Faturamento Mensal</span>
                            <span class="info-box-number">{{\App\Helper\ObjectHelper::toMoneyFormat( !empty($faturamentoMensal[0]) ? $faturamentoMensal[0]->valor : number_format(0,2))}}</span>
                            <!-- The progress section is optional -->
                            <div class="progress">
                                <div class="progress-bar" style="width: {{$porcentagemDoDiaDoMes}}%"></div>
                            </div>
                            <span class="progress-description">
                                {{$diaDeHoje}}º dia de {{$ultimoDiaDoMes}} dias
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>

                <div class="col-md-4">
                    <div class="info-box">
                        <!-- Apply any bg-* class to to the icon to color it -->
                        <span class="info-box-icon bg-red"><i class="fa fa-files-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Ordens de seriços abertas</span>
                            <span class="info-box-number">{{$ordemDeServicoAberto}}</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>Produtos/Serviços mais consumidos</h4>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="pieChart" style="height: 247px; width: 495px;" width="495" height="247"></canvas>
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript" src="{{asset('js/chartjs-plugin-colorschemes.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/chartjs-plugin-labels.min.js')}}"></script>
    <script>
        $.ajax({
            url: '/dashboard/maisConsumidos', //this is your uri
            type: 'GET', //this is your method
            dataType: 'json',
            success: function(response){
                data = {
                    datasets: [{
                        data: [],
                    }],
                    labels: []
                };
                response.map(maisConsumido => {
                    data.datasets[0].data.push(maisConsumido.quantidade);
                    data.labels.push(maisConsumido.descricao);
                });

                getDataPieChart(data);
            }
        });

       function getDataPieChart(data){
            const ctx = document.getElementById('pieChart').getContext('2d');
            const myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: false,
                    maintainAspectRatio: true,
                    plugins: {
                        colorschemes: {
                            scheme: 'brewer.Paired12'
                        },
                        labels: {
                            render: 'porcentage',
                            fontSize: 14,
                            fontStyle: 'bold',
                            fontColor: '#000',
                            fontFamily: '"Lucida Console", Monaco, monospace'
                        }
                    },
                }
            });
        }
    </script>
@endsection