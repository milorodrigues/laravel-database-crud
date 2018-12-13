<?php

namespace App\Http\Controllers;

use App\Administradora;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdministradoraController extends Controller
{
    
    public function index(){
        return Administradora::all();
    }

    public function create(Request $request){

        /* $request deve ter os seguintes campos:
            > cnpj
            > razaosocial
            > telefone
            > idEndereco
        */

        $validity = true;
        $errormsg = '';

        $search = $this->read($request->cnpj);

        if (count($search)>0){
            $validity = false;
            $errormsg = 'CNPJ já existe no sistema!';

            return response()->json([
                'validity' => $validity,
                'errormsg' => $errormsg
            ]);
        }

        else {

            if ($this->validarCNPJ($request->cnpj)){

                $newInstance = array(
                    'CNPJ' => $request->cnpj,
                    'razaoSocial' => $request->razaosocial,
                    'telefone' => $request->telefone,
                    'Endereço_idEndereço' => $request->idEndereco
                );

                $newRow = Administradora::create($newInstance);

                return response()->json([
                    'validity' => $validity
                ]);

            } else {

                $validity = false;
                $errormsg = 'CNPJ inválido!';

                return response()->json([
                    'validity' => $validity,
                    'errormsg' => $errormsg
                ]);

            }
        }

    }

    public function read($query) {

        //$query deve ser o CNPJ da empresa.

        return Administradora::where('CNPJ', $query)->get();
    }

    public function updateField(Request $request) {

        /* $request deve conter:
            cnpj
            campo (campo q se deseja fazer update)
            valor(novo valor)
        */

        $validity = true;
        $errormsg = '';

        $administradora = new Administradora();
        $fillable = $administradora->getFillable();

        if (in_array($request->campo, $fillable)) {
            
            $search = Administradora::where('CNPJ', $request->cnpj);

            if (count($search->get()) != 1) {
                $validity = false;
                $errormsg = 'CNPJ não encontrado!';

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

        $search = Administradora::where('CNPJ', $query);

        if (count($search->get()) != 1){
            $validity = false;
            $errormsg = 'CNPJ não encontrado!';

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
