@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    <form role="form" method="post" action="{{Request::root()}}/User/add-User-post" >
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h2>Add User</h2>
        </div>
        <div class="box-body">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </form>




@endsection
