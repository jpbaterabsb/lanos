@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    <h2>Manage Cliente</h2>

    @if(Session::has('message'))
        <div class="alert alert-success">
            <strong><span class="glyphicon glyphicon-ok"></span>{{  Session::get('message') }}</strong>
        </div>
    @endif

    @if(count($Clientes)>0)
        <table class="table table-hover">
            <thead>
            <tr>
                <th>SL No</th>
                <th>nome</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1 ?>
            @foreach($Clientes as $Cliente)
                <tr>
                    <td>{{$i}} </td>
                    <td> <a href="{{Request::root()}}/Cliente/view-Cliente/{{$Cliente->id}}" > {{$Cliente->nome }}</a> </td>

                    <td>
                        <a href="{{Request::root()}}/Cliente/change-status-Cliente/{{$Cliente->id }}" > @if($Cliente->status==0) {{"Activate"}}  @else {{"Dectivate"}} @endif </a>
                        <a href="{{Request::root()}}/Cliente/edit-Cliente/{{$Cliente->id}}" >Edit</a>
                        <a href="{{Request::root()}}/Cliente/delete-Cliente/{{$Cliente->id}}" onclick="return confirm('are you sure to delete')">Delete</a>
                    </td>

                </tr>
                <?php $i++;  ?>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info" role="alert">
            <strong>No Clientes Found!</strong>
        </div>
    @endif
@endsection