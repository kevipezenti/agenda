<?php

namespace App\Services;

use App\Repositories\agendaRepository;
use App\Services\agendaValidation;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class agendaServices {

    private $objAgenda;

    public function __construct(agendaRepository $agenda){
        $this->objAgenda = $agenda;
    }

    public function salvarAgendamento($requests){

        $validacao = agendaValidation::validarAgendamento($requests);

        if($validacao->fails()){
            return response()->json([$validacao->errors(), SymfonyResponse::HTTP_BAD_REQUEST]);
        }

        $agendas = $this->objAgenda->buscarAgendas($requests);
  
        if(count($agendas)!=0){
            return response()->json([
                "status"=>"false",
                "response"=>"Sala agendada para data e horario definido."
                ]);
        }

        return $this->objAgenda->salvarAgendamento($requests->all());

    }

    public function cancelarAgendamentos($requests){

        $validacao = agendaValidation::validarCancelamento($requests);

        if($validacao->fails()){
            return response()->json([$validacao->errors(), SymfonyResponse::HTTP_BAD_REQUEST]);
        }

        $cancelar = $this->objAgenda->buscarAgendaCancelar($requests);
        if(count($cancelar->get())==0){
            return response()->json([
                "status"=>"false",
                "response"=>"Nao foi encontrado agenda para cancelar."
                ]);
        }

        return $this->objAgenda->cancelarAgendamentos($requests);

    }

    public function listarAgendamentos($data){

        $validacao = agendaValidation::validarListarAgendamentos($data);

        if($validacao->fails()){
            return response()->json([$validacao->errors(), SymfonyResponse::HTTP_BAD_REQUEST]);
        }

        return $this->objAgenda->listarAgendamentos($data);
    }
}