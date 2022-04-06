<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Pais;
use App\Http\Requests\PessoaRequest;

class PessoaController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $pais = Pais::all();
        $pessoas = Pessoa::orderBy('id','desc')->paginate(5);

        return view('pessoas.index', compact('pessoas', 'pais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PessoaRequest  $request
     * @return \Illuminate\Http\PessoaRequest
     */
    public function store(PessoaRequest $request)
    {        
        $pessoa = Pessoa::find($request->id);
        if (!$pessoa){
            $nextId  = DB::select("select nextval('seq_pessoa')");     
            $id = intval($nextId['0']->nextval);
            $dados = [
                'id' => $id,
                'nome' => $request->nome,
                'nascimento' => $request->nascimento,
                'genero' => $request->genero,
                'pais_id' => $request->pais_id
            ];    
            Pessoa::create($dados);

        } else {
            $id = $request->id;
            $dados = $request->all();
            $pessoa->update($dados);
        }

        return response()->json(['success' => true]);
    }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    { 
        $pessoa = Pessoa::find($request->id);       
        
        $dados = $request->all();
        $pessoa->update($dados);

        return response()->json($pessoa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Pessoa::where('id',$request->id)->delete();
   
        return response()->json(['success' => true]);
    }

}
