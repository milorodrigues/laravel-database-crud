<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posse extends Model
{
	protected $table = 'posse';
	public $timestamps = false;

	protected $primarykey = 'numContrato';
	public $incrementing = false;

    protected $fillable = ['numContrato', 'Cliente_CPF', 'Unidade_numero', 'Unidade_Condomínio_nome'];
}