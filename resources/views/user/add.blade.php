@extends('adminlte::page')
@section('title', 'Lano\'s Informatica - Home')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form role="form" method="post" action="/user" >
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h2 style="text-align: center">Cadastrar usuário</h2>
        </div>
        <div class="box-body">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="password">Confirmar Senha:</label>
                    <input type="password" class="form-control" id="confirmationPassword" name="confirmationPassword">
                </div>
            </div>
        @if(\App\Helper\ObjectHelper::currentUserIsAdmin())
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="nivel">Nivel:</label>
                        <select class="form-control" id="nivel" name="nivel">
                            <option value="ADMIN">ADMIN</option>
                            <option value="USER" selected="selected">USER</option>
                        </select>
                    </div>
                </div>
            @endif
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </form>




@endsection
