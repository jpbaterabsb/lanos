@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success">
            <strong><span class="glyphicon glyphicon-ok"></span>{{  Session::get('message') }}</strong>
        </div>
    @endif
<div class="box">
    <div class="box-header">
    <h2>Manage OrdemServico</h2>
    </div>
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
                            <a href="{{Request::root()}}/OrdemServico/change-status-OrdemServico/{{$OrdemServico->id }}" > @if($OrdemServico->status==0) {{"Activate"}}  @else {{"Dectivate"}} @endif </a>
                            <a href="{{Request::root()}}/OrdemServico/edit-OrdemServico/{{$OrdemServico->id}}" >Edit</a>
                            <a href="{{Request::root()}}/OrdemServico/delete-OrdemServico/{{$OrdemServico->id}}" onclick="return confirm('are you sure to delete')">Delete</a>
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
</div>
@endsection