<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $fillable = [
        "nome",
        "email",
        "celular",
        "telefone",
        "cep",
        "numer",
        "endereco",
        "bairro",
        "complemento",
        "cidade",
        "estado",
    ];
}
