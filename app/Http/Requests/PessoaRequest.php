<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $hoje = new \DateTime();
        $intervalo = new \DateInterval('P01D');
        $date = $hoje->add($intervalo);
        $hoje = $date->format('Y-m-d');
        return [
            "nome" => "required | string | min:3 | max:50",
            "nascimento" => "required | date | before:.$hoje",             
            "genero" => "max:1",             
            "pais_id" => "required | numeric",
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function($validator){
            if ($this->genero()) {
                $validator->errors()
                 ->add('genero', 'o campo genero dever ser informado Masculino, Feminino ou Não informado');    
            }    
        });
    }

    public function genero()
    {       
        $data = $this->all();
     
        if ($data['genero'] !== 'M' && $data['genero'] !== 'F' && $data['genero'] !== null){
 
            return true;
        }
    }

}
