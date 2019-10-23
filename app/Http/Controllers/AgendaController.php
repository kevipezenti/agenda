<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    
    private $obj_banco;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Agenda $agenda){
        
        $this->obj_banco = $agenda;
    }

    public function Agendar(Request $request){
        $agendados = $this->obj_banco->query();

        $agenda = $agendados->where([
            'data_inicio','=',$request->json('data_inicio'),
            'AND',
            'id_sala','=',$request->json('id_sala')
        ])->get();
        // return $request->json('data_inicio');
        return dd($agenda);
        // $agenda = $this->obj_banco->create($request->all());

        // return response()->json($agenda);
        // return $request->all(['data_inicio','id_sala']);
    }

    public function Cancelar(){
        return "Cancelar";
    }

    public function Listar($data){
    
        $agendas = $this->obj_banco->find($data);

        return response()->json($agendas);
    }
}
