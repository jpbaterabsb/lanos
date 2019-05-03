@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')

@section('content')
    <h2>Update User</h2>
    <form role="form" method="post" action="{{Request::root()}}/User/edit-User-post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" value="<?php echo $User->id ?>"   name="User_id">


        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" value="<?php echo $User->name ?>" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" value="<?php echo $User->email ?>" class="form-control" id="email" name="email">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection