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


    <form role="form" method="post" action="/user/edit" enctype="multipart/form-data">
        <div class="box box-solid box-primary">
            <div class="box-header">
                @if(\Illuminate\Support\Facades\Request::path() == 'perfil')
                    <h2>Meu Perfil</h2>
                @else
                    <h2>Editar Usuario</h2>
                @endif

            </div>
            <div class="box-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" value="<?php echo $User->id ?>" name="User_id">

                @if(App\Helper\ObjectHelper::isOwner($User->id))
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" value="<?php echo $User->name ?>" class="form-control" id="name"
                                   name="name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" value="<?php echo $User->email ?>" class="form-control" id="email"
                                   name="email">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="hidden" name="hasAlteracaoSenha" id="hasAlteracaoSenha" value="0"/>
                            <button type="button" class="btn btn-primary" onclick="mudarSenha()">Mudar a senha</button>
                        </div>
                    </div>

                    <div id="change-password">
                    </div>
                @else
                    <input type="hidden" id="nivel" name="nivel" value="{{$User->name}}"/>
                    <input type="hidden" id="nivel" name="nivel" value="{{$User->email}}"/>
                    <input type="hidden" id="nivel" name="nivel" value="{{$User->password}}"/>
                @endif

                @if(\App\Helper\ObjectHelper::currentUserIsAdmin())
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nivel">Nivel:</label>
                            <select class="form-control" id="nivel" name="nivel">
                                <option selected value="ADMIN">ADMIN</option>
                                <option
                                    @if($User->nivel == 'USER')
                                    selected
                                    @endif
                                    value="USER">USER
                                </option>
                            </select>
                        </div>
                    </div>
                @else
                    <input type="hidden" id="nivel" name="nivel" value="{{$User->nivel}}"/>
                @endif

            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script>
        function mudarSenha() {
            let changePassword = $('#change-password');
            if (changePassword.children().length == 0) {
                $('#hasAlteracaoSenha').val('1');
                changePassword.append(`
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="old-password">Senha Antiga:</label>
                        <input type="password" value="" class="form-control" id="old-password" name="old-password">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="new-password">Nova Senha:</label>
                        <input type="password" value="" class="form-control" id="new-password" name="new-password">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="confirm-password">Confirmar Senha:</label>
                        <input type="password" value="" class="form-control" id="confirm-password" name="confirm-password">
                    </div>
                </div>
                `);
            } else {
                $('#hasAlteracaoSenha').val('0');
                changePassword.empty();
            }
        }

    </script>
@endsection
