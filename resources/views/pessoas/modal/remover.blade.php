     <div class="modal fade" id="ModalRemover{{$pessoa->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Remover Pessoa</h4>
                </div>   
                <div class="modal-doby">
                    <form action="{{ route('pessoas.remover', $pessoa->id) }}" method="POST">            
                        @method('DELETE') 
                        @csrf

                        <input type="hidden" name="id" value="{{$pessoa->id ?? ''}}">  
                        <div class="row">  
                            <div class="col-md-12"> 
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input readonly type="text" class="form-control" placeholder="Nome" name="nome" maxlength="50" required value="{{ old('nome', $pessoa->nome ?? '') }}">
                                </div>
                            </div> 
                        </div> 
                        <div class="row"> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nascimento">Nascimento</label>                                                                                          
                                    <input readonly type="text" class="form-control" data-mask="00/00/0000" placeholder="Data de Nascimento" name="nascimento" required value="{{ date_to_br(old('nascimento', $pessoa->nascimento ?? '')) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="genero">Genero</label>                            
                                    <select readonly class="form-control" name="genero" id="genero">
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
                                    <select readonly class="form-control" name="pais_id" required>
                                    @foreach($pais as $p)            
                                        <option value="{{$p->id}}">{{$p->nome}}</option>            
                                    @endforeach
                                    </select>
                                </div> 
                            </div>
                        </div>                       

                        <div class="modal-footer">                         
                            <button type="submit" class="btn btn-primary">Remover</button>
                            <button class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>                
                </div>                    
            </div>
        </div>
    </div>