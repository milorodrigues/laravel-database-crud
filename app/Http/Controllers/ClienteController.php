<?php

namespace App\Http\Controllers;

use App\Cliente;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClienteController extends Controller
{
    
    public function index(){
        return Cliente::all();
    }

    public function create(Request $request){

        /* $request deve ter os seguintes campos:
            > cpf
            > nome
            > telefone
        */

        $validity = true;
        $errormsg = '';

        $search = $this->read($request->cpf);

        if (count($search)>0){
            $validity = false;
            $errormsg = 'CPF já cadastrado no sistema!';

            return response()->json([
                'validity' => $validity,
                'errormsg' => $errormsg
            ]);
        }

        else {

            if ($this->validarCPF($request->cpf)){

                $newInstance = array(
                    'CPF' => $request->cpf,
                    'nome' => $request->nome,
                    'telefone' => $request->telefone
                );

                $newRow = Cliente::create($newInstance);

                return response()->json([
                    'validity' => $validity
                ]);

            } else {

                $validity = false;
                $errormsg = 'CPF inválido!';

                return response()->json([
                    'validity' => $validity,
                    'errormsg' => $errormsg
                ]);

            }
        }

    }

    public function read($query) {

        //$query deve ser o CPF.

        return Cliente::where('CPF', $query)->get();
    }

    public function updateField(Request $request) {

        /* $request deve conter:
            cpf
            campo (campo q se deseja fazer update)
            valor (novo valor)
        */

        $validity = true;
        $errormsg = '';

        $cliente = new Cliente();
        $fillable = $cliente->getFillable();

        if (in_array($request->campo, $fillable)) {
            
            $search = Cliente::where('CPF', $request->cpf);

            if (count($search->get()) != 1) {
                $validity = false;
                $errormsg = 'Cliente não encontrado!';

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

        $search = Cliente::where('CPF', $query);

        if (count($search->get()) != 1){
            $validity = false;
            $errormsg = 'Cliente não encontrado!';

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

    private function validarCPF($query) {

        if (strlen($query) == 11) {
            return true;
        } else {
            return false;
        }
    }

}
