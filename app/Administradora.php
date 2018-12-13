<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administradora extends Model
{
	protected $table = 'administradora';
	public $timestamps = false;

	protected $primarykey = 'CNPJ';
	public $incrementing = false;
	protected $keyType = 'string';

    protected $fillable = ['CNPJ', 'razaoSocial', 'telefone', 'Endereço_idEndereço'];

    /*
    public function getFillable(){
    	return $this->fillable;
    }
	*/
}
