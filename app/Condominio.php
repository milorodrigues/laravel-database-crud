<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condominio extends Model
{
	protected $table = 'condomínio';
	public $timestamps = false;

	protected $primarykey = 'nome';
	public $incrementing = false;
	protected $keyType = 'string';

    protected $fillable = ['nome', 'Endereço_idEndereço'];
}