<?php

namespace App\Http\Controllers;

use App\Posse;

use App\Unidade;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PosseController extends Controller
{
    
    public function index(){
        return Posse::all();
    }

    public function create(Request $request){

        /* $request deve ter os seguintes campos:
            > numContrato
            > unidadeNum
            > unidadeCondominio
            > clienteCPF
        */

        $validity = true;
        $errormsg = '';

        $searchUnidade = Unidade::where('numero', $request->unidadeNum);

        if ($this->validarCPF($request->clienteCPF) && count($searchUnidade->get()) == 1){

            $newInstance = array(
                'numContrato' => $request->numContrato,
                'Unidade_numero' => $request->unidadeNum,
                'Unidade_Condomínio_nome' => $request->unidadeCondominio,
                'Cliente_CPF' => $request->clienteCPF
            );

            $newRow = Posse::create($newInstance);

            return response()->json([
                'validity' => $validity
            ]);

        } else {

            $validity = false;
            $errormsg = 'Dados inválidos!';

            return response()->json([
                'validity' => $validity,
                'errormsg' => $errormsg
            ]);

        }

    }

    public function read($query) {

        //$query deve ser o número do contrato.

        return Posse::where('numContrato', $query)->get();
    }

    public function updateField(Request $request) {

        /* $request deve conter:
            numContrato
            campo (campo q se deseja fazer update)
            valor (novo valor)
        */

        $validity = true;
        $errormsg = '';

        $Posse = new Posse();
        $fillable = $Posse->getFillable();

        if (in_array($request->campo, $fillable)) {
            
            $search = Posse::where('numContrato', $request->numContrato);

            if (count($search->get()) != 1) {
                $validity = false;
                $errormsg = 'Contrato não encontrado!';

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

        $search = Posse::where('numContrato', $query);

        if (count($search->get()) != 1){
            $validity = false;
            $errormsg = 'Contrato não encontrado!';

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
