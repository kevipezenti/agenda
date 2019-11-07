<?php

namespace App\Http\Controllers;

use Illuminate\http\Request;
use App\Services\agendaServices;

class agendaController extends Controller
{
    
    private $objServices;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(agendaServices $service){
        
        $this->objServices = $service;
    }

   /**
    * Undocumented function
    *
    * @param request $request
    * @return void
    */
    public function agendar(Request $request){

        return $this->objServices->salvarAgendamento($request);

    }

    public function cancelar(Request $request){

        return $this->objServices->cancelarAgendamentos($request);

    }

    public function listar($data){
        
        return $this->objServices->listarAgendamentos($data);

    }
}
