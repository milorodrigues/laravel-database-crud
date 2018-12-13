<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluguel extends Model
{
	protected $table = 'aluguel';
	public $timestamps = false;

	protected $primarykey = 'numContrato';
	public $incrementing = false;

    protected $fillable = ['numContrato', 'Unidade_numero', 'Unidade_Condomínio_nome', 'Cliente_CPF'];

    
}
