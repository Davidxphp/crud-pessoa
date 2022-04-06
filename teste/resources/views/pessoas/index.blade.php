<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Laravel Jquery Ajax</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12 card-header text-center font-weight-bold">
          <h2>CRUD - Laravel Jquery Ajax</h2>
        </div>

        @if($errors->any())
          <div class="alert alert-danger" role="alert">
              @foreach ($errors->all() as $error)
                  {{ $error }}<br>
              @endforeach
          </div>
        @endif 

        <div class="col-md-12 mt-1 mb-2"><button type="button" id="addNew" class="btn btn-success">Novo</button></div>
        <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Nascimento</th>
                  <th scope="col">Genero</th>
                  <th scope="col">Pais</th>
                  <th scope="col">Acões</th>
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
                        <a href="javascript:void(0)" class="btn btn-primary edit" data-id="{{ $pessoa->id }}">Editar</a>
                        <a href="javascript:void(0)" class="btn btn-danger delete" data-id="{{ $pessoa->id }}">Excluir</a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
             {!! $pessoas->links() !!}
        </div>
    </div>        
</div>
<!-- boostrap model -->
    <div class="modal fade" id="ajax-model" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ajaxModel"></h4>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="addEditForm" name="addEditForm" class="form-horizontal" method="POST">
              <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label for="nome" class="col-sm-2 control-label">Nome</label>
               
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" value="" maxlength="50" required>
                </div>
              </div>  
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nascimento</label>
                <div class="col-sm-12">
                  <input type="date" class="form-control" id="nascimento" name="nascimento" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="genero" class="col-sm-2 control-label">Genero</label>
                <div class="col-sm-12">
                  <select class="form-control" name="genero" id="genero">
                    <option 
                        {{ ($pessoa->genero ?? '') === 'M' ? 'selected' : '' }}
                        value="{{ 'M' }}">
                        {{ 'Masculino' }}
                    </option>
                    <option 
                        {{ ($pessoa->genero ?? '') === 'F' ? 'selected' : '' }}
                        value="{{ 'F' }}">
                        {{ 'Feminino' }}
                    </option>
                    <option 
                        {{ ($pessoa->genero ?? '') === '' ? 'selected' : '' }}
                        value="{{ '' }}">
                        {{ 'Não informado' }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="pais_id" class="col-sm-12 control-label">Selecione o Pais</label>
                <div class="col-sm-12">
                  <select class="form-control" name="pais_id" id="pais_id" required>
                    @foreach($pais as $p)            
                      <option value="{{$p->id}}">{{$p->nome}}</option>            
                    @endforeach
                  </select>
                </div>
              </div> 
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="btn-save" value="addNew">Salvar
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>
<!-- end bootstrap model -->
<script type="text/javascript">
 $(document).ready(function($){
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')        
        }
    });
    $('#addNew').click(function () {
       $('#addEditForm').trigger("reset");
       $('#ajaxModel').html("Nova Pessoa");
       $('#ajax-model').modal('show');
    });
 
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
       
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('edit') }}",
            data: { id: id },
            dataType: 'json',
            
            success: function(res){
              $('#ajaxModel').html("Editar Pessoa");
              $('#ajax-model').modal('show');
              $('#id').val(res.id);
              $('#nome').val(res.nome);
              $('#nascimento').val(res.nascimento);
              $('#genero').val(res.genero);
              $('#pais_id').val(res.pais_id);
           }
        });
    });
    $('body').on('click', '.delete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('delete') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              window.location.reload();
           }
        });
       }
    });
    $('body').on('click', '#btn-save', function (event) {
          var id = $("#id").val();
          var nome = $("#nome").val();
          var nascimento = $("#nascimento").val();
          var genero = $("#genero").val();
          var pais_id = $("#pais_id").val();
          $("#btn-save").html('Por favor aguarde...');
          $("#btn-save"). attr("disabled", true);
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('add-update') }}",
            data: {
              id:id,
              nome:nome,
              nascimento:nascimento,
              genero:genero,
              pais_id:pais_id,
            },
            dataType: 'json',
            success: function(res){
             window.location.reload();
            $("#btn-save").html('Submit');
            $("#btn-save"). attr("disabled", false);
           }
        });
    });
});
</script>
</body>
</html>

