<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{//public $primaryKey = 'id';
    
    public $timestamps = false;
    
    protected $table = 'pais';

    protected $fillable = [
        "id", "nome"
    ];

    public function pessoas(){
        return $this->hasMany('App\Models\Pessoa', 'pais_id');
    }

}