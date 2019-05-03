@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    <h2>Manage OrdemServico</h2>

    @if(Session::has('message'))
        <div class="alert alert-success">
            <strong><span class="glyphicon glyphicon-ok"></span>{{  Session::get('message') }}</strong>
        </div>
    @endif

    @if(count($OrdemServicos)>0)
        <table class="table table-hover">
            <thead>
            <tr>
                <th>SL No</th>
                <th>descricao</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($OrdemServicos as $OrdemServico)
                <tr>
                    <td>{{$i}} </td>
                    <td> <a href="{{Request::root()}}/OrdemServico/view-OrdemServico/{{$OrdemServico->id}}" > {{$OrdemServico->descricao }}</a> </td>

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
@endsection