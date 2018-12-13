<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
	protected $table = 'unidade';
	public $timestamps = false;
    
	protected $primarykey = 'numero';
    public $incrementing = false;

    protected $fillable = ['numero', 'Condomínio_nome', 'Administradora_CNPJ', 'Endereço_idEndereço'];

}