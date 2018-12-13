<?php

namespace App\Http\Controllers;

use App\Condominio;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CondominioController extends Controller
{
    
    public function index(){
        return Condominio::all();
    }

    public function create(Request $request){

        /* $request deve ter os seguintes campos:
            > nome
            > idEndereco
        */

        //return response()->json([ 'oi' => 'oi ']);

        $validity = true;
        $errormsg = '';

        $search = $this->read($request->nome);

        if (count($search)>0){
            $validity = false;
            $errormsg = 'Nome já cadastrado!';

            return response()->json([
                'validity' => $validity,
                'errormsg' => $errormsg
            ]);
        }

        else {

            $newInstance = array(
                'nome' => $request->nome,
                'Endereço_idEndereço' => $request->idEndereco
            );

            $newRow = Condominio::create($newInstance);

            return response()->json([
                'validity' => $validity
            ]);
        }
    }

    public function read($query) {

        //$query deve ser o nome.

        return Condominio::where('nome', $query)->get();
    }

    public function updateField(Request $request) {

        /* $request deve conter:
            nome
            campo (campo q se deseja fazer update)
            valor (novo valor)
        */

        $validity = true;
        $errormsg = '';

        $condominio = new Condominio();
        $fillable = $condominio->getFillable();

        if (in_array($request->campo, $fillable)) {
            
            $search = Condominio::where('nome', $request->nome);

            if (count($search->get()) != 1) {
                $validity = false;
                $errormsg = 'Condominio não encontrado!';

                return response()->json([
                    'validity' => $validity,
                    'errormsg' => $errormsg
                ]);
            } else {

                $try = $search->update([$request->campo => $request->valor]);

                if ($try == 0) {
                    $validity = false;
                    $errormsg = 'Nenhuma célula alterada.';
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

        $search = Condominio::where('nome', $query);

        if (count($search->get()) != 1){
            $validity = false;
            $errormsg = 'Condominio não encontrado!';

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

}
