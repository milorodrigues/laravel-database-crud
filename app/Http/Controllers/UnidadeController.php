<?php

namespace App\Http\Controllers;

use App\Unidade;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UnidadeController extends Controller
{
    
    public function index(){
        return Unidade::all();
    }

    public function create(Request $request){

        /* $request deve ter os seguintes campos:
            > numero
            > condominio
            > administradora
            > idEndereco
        */

        $validity = true;
        $errormsg = '';

        $search = Unidade::where('Endereço_idEndereço', $request->idEndereco);

        if (count($search->get())>0){
            $validity = false;
            $errormsg = 'Já existe uma unidade cadastrada nesse endereço!';

            return response()->json([
                'validity' => $validity,
                'errormsg' => $errormsg
            ]);
        }

        else {

            $newInstance = array(
                'numero' => $request->numero,
                'Condomínio_nome' => $request->condominio,
                'Administradora_CNPJ' => $request->administradora,
                'Endereço_idEndereço' => $request->idEndereco
            );

            $newRow = Unidade::create($newInstance);

            return response()->json([
                'validity' => $validity
          	]);

        }

    }

    public function read($query) {

        //$query deve ser o número da unidade.

        return Unidade::where('numero', $query)->get();
    }

    public function updateField(Request $request) {

        /* $request deve conter:
            numero
            campo (campo q se deseja fazer update)
            valor(novo valor)
        */

        $validity = true;
        $errormsg = '';

        $Unidade = new Unidade();
        $fillable = $Unidade->getFillable();

        if (in_array($request->campo, $fillable)) {
            
            $search = Unidade::where('numero', $request->numero);

            if (count($search->get()) != 1) {
                $validity = false;
                $errormsg = 'Unidade não encontrada!';

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

        $search = Unidade::where('numero', $query);

        if (count($search->get()) != 1){
            $validity = false;
            $errormsg = 'Unidade não encontrada!';

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
