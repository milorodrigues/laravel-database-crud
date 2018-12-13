<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	protected $table = 'cliente';
	public $timestamps = false;
	
	protected $primarykey = 'CPF';
	public $incrementing = false;
	protected $keyType = 'string';

    protected $fillable = ['CPF', 'nome', 'telefone'];
}
