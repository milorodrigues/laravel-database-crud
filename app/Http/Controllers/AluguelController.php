<?php

namespace App\Http\Controllers;

use App\Aluguel;

use App\Unidade;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AluguelController extends Controller
{
    
    public function index(){
        return Aluguel::all();
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

        $search = $this->read($request->numContrato);

        if (count($search)>0){
            $validity = false;
            $errormsg = 'Já existe um contrato com esse número no sistema!';

            return response()->json([
                'validity' => $validity,
                'errormsg' => $errormsg
            ]);
        }

        else {

            $searchUnidade = Unidade::where('numero', $request->unidadeNum);
            $searchAluguel = Aluguel::where('Unidade_numero', $request->unidadeNum);

            if ($this->validarCPF($request->clienteCPF) && count($searchUnidade->get()) == 1){

                if (count($searchAluguel->get()) == 0) {
                    $newInstance = array(
                        'numContrato' => $request->numContrato,
                        'Unidade_numero' => $request->unidadeNum,
                        'Unidade_Condomínio_nome' => $request->unidadeCondominio,
                        'Cliente_CPF' => $request->clienteCPF
                    );

                    $newRow = Aluguel::create($newInstance);

                    return response()->json([
                        'validity' => $validity
                    ]);

                } else {

                    $validity = false;
                    $errormsg = 'Unidade ja alugada!';

                    return response()->json([
                        'validity' => $validity,
                        'errormsg' => $errormsg
                    ]);

                }

            } else {

                $validity = false;
                $errormsg = 'Dados inválidos!';

                return response()->json([
                    'validity' => $validity,
                    'errormsg' => $errormsg
                ]);

            }
        }

    }

    public function read($query) {

        //$query deve ser o número do contrato.

        return Aluguel::where('numContrato', $query)->get();
    }

    public function updateField(Request $request) {

        /* $request deve conter:
            numContrato
            campo (campo q se deseja fazer update)
            valor (novo valor)
        */

        $validity = true;
        $errormsg = '';

        $aluguel = new Aluguel();
        $fillable = $aluguel->getFillable();

        if (in_array($request->campo, $fillable)) {
            
            $search = Aluguel::where('numContrato', $request->numContrato);

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

        $search = Aluguel::where('numContrato', $query);

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
