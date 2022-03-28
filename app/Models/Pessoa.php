<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    //public $primaryKey = 'id';
    
    public $timestamps = false;

    protected $table = 'pessoa';

    protected $fillable = [
        "id", "nome", "nascimento", "genero", "pais_id"
    ];

    public function pais(){
        return $this->belongsTo('App\Models\Pais', 'pais_id');
    }

}

// CREATE TABLE public.pessoa
// (
//     id integer NOT NULL,
//     nome character varying(50) NOT NULL,
//     nascimento date,
//     genero character(1),
//     pais_id integer NOT NULL,
//     PRIMARY KEY (id)
// )