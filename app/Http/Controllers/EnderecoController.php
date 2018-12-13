<?php

namespace App\Http\Controllers;

use App\Endereco;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnderecoController extends Controller
{
    
    public function index(){
        return Endereco::all();
    }

    public function create(Request $request){

        /* $request deve ter os seguintes campos:
            > rua
            > numero
            > complemento
            > cep
            > cidade
            > estado
        */

        $validity = true;
        $errormsg = '';

        $newInstance = array(
            'rua' => $request->rua,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'CEP' => $request->cep,
            'cidade' => $request->cidade,
            'estado' => $request->estado
        );

        $newRow = Endereco::create($newInstance);

        return response()->json([
            'validity' => $validity
        ]);
    }

    public function read($query) {

        //$query deve ser o ID do endereço.

        return Endereco::where('idEndereço', $query)->get();
    }

    public function updateField(Request $request) {

        /* $request deve conter:
            id
            campo (campo q se deseja fazer update)
            valor(novo valor)
        */

        $validity = true;
        $errormsg = '';

        $endereco = new Endereco();
        $fillable = $endereco->getFillable();

        if (in_array($request->campo, $fillable)) {
            
            $search = Endereco::where('idEndereço', $request->id);

            if (count($search->get()) != 1) {
                $validity = false;
                $errormsg = 'Endereço não encontrado!';

                return response()->json([
                    'validity' => $validity,
                    'errormsg' => $errormsg
                ]);
            } else {

                $try = $search->update([$request->campo => $request->valor]);

                if ($try == 0) {
                    $validity = false;
                    $errormsg = 'Nenhuma celula alterada.';
                }

                return response()->json([
                    'validity' => $validity,
                    'errormsg' => $errormsg
                ]);

            }

        } else {
            $validity = false;
            $errormsg = 'Campo inválido!';

            return response()->json([
                'validity' => $validity,
                'errormsg' => $errormsg
            ]);
        }
    }

    public function erase($query) {

        $validity = true;
        $errormsg = '';

        $search = Endereco::where('idEndereço', $query);

        if (count($search->get()) != 1){
            $validity = false;
            $errormsg = 'Endereço não encontrado!';

            return response()->json([
                'validity' => $validity,
                'errormsg' => $errormsg
            ]);
        }

        $search->delete();

        return response()->json([
            'validity' => $validity,
            'errormsg' => $errormsg
        ]);

    }

    private function validarCNPJ($query) {

        if (strlen($query) == 14) {
            return true;
        } else {
            return false;
        }

    }

}
