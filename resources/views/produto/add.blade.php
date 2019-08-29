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


    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
    <script src="{{asset('js/jquery.autocomplete.js')}}"></script>
    <script src="{{asset('js/util.js')}}"></script>
    <link href="{{asset('css/jquery.autocomplete.css')}}" rel="stylesheet"/>
    <form role="form" method="post" action="/produto" >
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h2>Criar Produto</h2>
        </div>
        <div class="box-body">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="descricao">Descricao:</label>
                    <input type="text" class="form-control" id="descricao" name="descricao">
                </div>

                <div class="form-group">
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade">
                </div>
                <div class="form-group">
                    <label for="valor">Valor:</label>
                    <input type="text" class="form-control money" id="valor" name="valor">
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <select class="form-control" id="categoria" name="categoria">
                        @foreach($Categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                        @endforeach
                    </select>
                </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
    </form>
@endsection


