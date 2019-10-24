<?php

namespace App\Http\Controllers;

use Illuminate\http\Request;
use App\Services\AgendaServices;

class AgendaController extends Controller
{
    
    private $ObjServices;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AgendaServices $service){
        
        $this->ObjServices = $service;
    }

    public function Agendar(Request $request){

        if($this->ObjServices->BuscarAgendas($request)){
            return response()->json([
                "status"=>"false",
                "response"=>"Sala agendada para data e horario definido."
                ]);
        }
        
        return $this->ObjServices->SalvarAgendamento($request);

    }

    public function Cancelar(Request $request){

        if($this->ObjServices->BuscarAgendaCancelar($request)){
            return response()->json([
                "status"=>"false",
                "response"=>"Nao foi encontrado agenda para excluir."
                ]);
        }

        return $this->ObjServices->CancelarAgendamentos($request);

    }

    public function Listar($data){
        
        return $this->ObjServices->ListarAgendamentos($data);

    }
}
