<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Pagination\Paginator;
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
        $qtd = $request['qtd'] ?: 5;
        $page = $request['page'] ?: 1;
        $buscar = $request['buscar'];

        $pais = Pais::all();
        Paginator::currentPageResolver(function () use ($page){
            return $page;
        });

        if($buscar){
            $pessoas = Pessoa::where('nome','=', $buscar)->paginate($qtd);
        }else{  
            $pessoas = Pessoa::paginate($qtd);

        }
        $pessoas = $pessoas->appends(Request::capture()->except('page'));
     
        return view('pessoas.index', compact('pessoas', 'pais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pais = Pais::all();
     
        return view('pessoas.create', compact('pais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PessoaRequest  $request
     * @return \Illuminate\Http\PessoaRequest
     */
    public function store(PessoaRequest $request)
    { 
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

        return back()->with('flash', "Pessoa de id: $id e nome: $request->nome , foi cadastrada corretamente!!");

    }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PessoaRequest $request, $id)
    {  
        $pessoa = Pessoa::find($id);       
        $dados = $request->all();    
        $pessoa->update($dados);

        return back()->with('flash', "Pessoa de id: $id e nome: $request->nome , foi alterada corretamente!!");
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pessoa::find($id)->delete();

        return back()->with('flash', "Pessoa removida corretamente!!");
    }

}
