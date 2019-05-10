@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    <h2>Manage User</h2>

    @if(Session::has('message'))
        <div class="alert alert-success">
            <strong><span class="glyphicon glyphicon-ok"></span>{{  Session::get('message') }}</strong>
        </div>
    @endif

    @if(count($Users)>0)
        <table class="table table-hover">
            <thead>
            <tr>
                <th>SL No</th>
                <th>name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1 ?>
            @foreach($Users as $User)
                <tr>
                    <td>{{$i}} </td>
                    <td> <a href="{{Request::root()}}/User/view-User/{{$User->id}}" > {{$User->name }}</a> </td>

                    <td>
{{--                        <a href="{{Request::root()}}/User/change-status-User/{{$User->id }}" > @if($User->status==0) {{"Ativar"}}  @else {{"Desativar"}} @endif </a>--}}
                        <a href="{{Request::root()}}/User/edit-User/{{$User->id}}" >Editar</a>
                        <a href="{{Request::root()}}/User/delete-User/{{$User->id}}" onclick="return confirm('are you sure to delete')">Delete</a>
                    </td>

                </tr>
                <?php $i++;  ?>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info" role="alert">
            <strong>No Users Found!</strong>
        </div>
    @endif
@endsection