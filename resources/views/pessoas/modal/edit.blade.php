    <div class="modal fade" id="ModalEdit{{$pessoa->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edita  Pessoa</h4>
                </div>   
                <div class="modal-doby">
                   
                    <form action="{{ route('pessoas.update', $pessoa->id) }}" method="POST">            
                        @method('PUT') 
                        @csrf

                        <input type="hidden" name="id" value="{{$pessoa->id ?? ''}}">  
                        <div class="row">  
                            <div class="col-md-12"> 
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" placeholder="Nome" name="nome" maxlength="50" required value="{{ old('nome', $pessoa->nome ?? '') }}">
                                </div>
                            </div> 
                        </div> 
                        <div class="row"> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nascimento">Nascimento</label>                                                                                          
                                    <input type="date" class="form-control"  placeholder="Data de Nascimento" name="nascimento" required value="{{ old('nascimento', $pessoa->nascimento ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="genero">Genero</label>                            
                                    <select class="form-control" name="genero" id="genero">
                                        <option 
                                            {{ ($pessoa->genero ?? '') === '' ? 'selected' : '' }}
                                            value="{{ '' }}">
                                            {{ 'Não informado' }}
                                        </option>                                 
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
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pais_id">Selecione o Pais</label>
                                    <select class="form-control" name="pais_id" required>
                                    @foreach($pais as $p)            
                                        <option value="{{$p->id}}">{{$p->nome}}</option>            
                                    @endforeach
                                    </select>
                                </div> 
                            </div>
                        </div>                       

                        <div class="modal-footer">
                          
                            <button type="submit" class="btn btn-primary">Salva</button>
                            <button class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>                
                </div>                    
            </div>
        </div>
    </div>