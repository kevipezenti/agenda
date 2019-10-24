<?php

namespace App\Services;

use App\Repositories\AgendaRepository;
use App\Services\AgendaValidation;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class AgendaServices {

    private $Obj_agenda;

    public function __construct(AgendaRepository $agenda){
        $this->Obj_agenda = $agenda;
    }

    public function SalvarAgendamento($Requests){

        $validacao = AgendaValidation::ValidarAgendamento($Requests);

        if($validacao->fails()){
            return response()->json([$validacao->errors(), SymfonyResponse::HTTP_BAD_REQUEST]);
        }

        $agendas = $this->Obj_agenda->BuscarAgendas($Requests);
  
        if(count($agendas)!=0){
            return response()->json([
                "status"=>"false",
                "response"=>"Sala agendada para data e horario definido."
                ]);
        }

        return $this->Obj_agenda->SalvarAgendamento($Requests->all());

    }

    public function CancelarAgendamentos($Requests){

        $validacao = AgendaValidation::ValidarCancelamento($Requests);

        if($validacao->fails()){
            return response()->json([$validacao->errors(), SymfonyResponse::HTTP_BAD_REQUEST]);
        }

        $cancelar = $this->Obj_agenda->BuscarAgendaCancelar($Requests);
        if(count($cancelar->get())==0){
            return response()->json([
                "status"=>"false",
                "response"=>"Nao foi encontrado agenda para cancelar."
                ]);
        }

        return $this->Obj_agenda->CancelarAgendamentos($Requests);

    }

    public function ListarAgendamentos($data){

        $validacao = AgendaValidation::ValidarListarAgendamentos($data);

        if($validacao->fails()){
            return response()->json([$validacao->errors(), SymfonyResponse::HTTP_BAD_REQUEST]);
        }

        return $this->Obj_agenda->ListarAgendamentos($data);
    }
}