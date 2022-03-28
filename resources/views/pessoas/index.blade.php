@extends('shared.base')
@section('content')
    <div class="panel panel-default"> 
        <div class="row">
            <div class="col-md-6">
                <a href="#"><button class="btn btn-primary" data-toggle="modal" data-target="#ModalCreate">Adicionar</button></a>
            </div>
            <div class="col-md-6">
                <div class="panel-heading">Lista de Pessoas</div>
            </div>                    
        </div>

        <form method="GET" action="{{route('pessoas.index', 'buscar' )}}">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Digite o nome da pessoa" name="buscar">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Pesquisar</button>
                    </span>
                </div>
            </div>
        </div>
        </form>
        <div class="row">

            <div class="container">
                @if (session('flash'))
                    <div class="alert alert-success" role="alert">
                        <strong>Aviso</strong>  {{session('flash')}} 
                        <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>    
                @endif
            </div>

            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Nascimento</th>
                            <th scope="col">Genero</th>
                            <th scope="col">Pais</th>                           
                            
                            <th>Acões</th>
                        </tr>
                    </thead>            
                    <tbody>            
                        @foreach($pessoas as $pessoa)
                            <tr>
                                <td scope="row">{{$pessoa->id}}</td>
                                <td>{{$pessoa->nome}}</td>
                                <td>{{ date_to_br($pessoa->nascimento) }}</td>
                                <td>{{ $pessoa->genero == '' ? 'Não informado' : ($pessoa->genero == 'M' ? 'Masculino' : 'Não informado') }}</td>
                                <td>{{$pessoa->pais->nome}}</td>
                                <td>                                   
                                    <a href="#" data-toggle="modal" data-target="#ModalEdit{{$pessoa->id}}"><i class="glyphicon glyphicon-pencil"></i></a>
                                    @include('pessoas.modal.edit')
                                                                                
                                    <a href="#" data-toggle="modal" data-target="#ModalRemover{{$pessoa->id}}"><i class="glyphicon glyphicon-trash"></i></a>
                                    @include('pessoas.modal.remover')
                                    
                                </td>                                
                            </tr>                         
                        @endforeach                                 
                    </tbody>
                </table> 
            </div> 
        </div>
        <div align="center" class="row">
        	{{ $pessoas->links() }}
	    </div>
    </div>
   
@endsection

@include('pessoas.modal.create')

