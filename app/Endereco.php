<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
	protected $table = 'endereço';
	public $timestamps = false;
	protected $primarykey = 'idEndereço';

    protected $fillable = ['idEndereço', 'rua', 'numero', 'complemento', 'CEP', 'cidade', 'estado'];

}