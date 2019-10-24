<?php

namespace App\Services;

use App\Repositories\AgendaInterfaceRepository;
use Illuminate\Support\Facades\Response;

class AgendaServices extends AgendaValidation{

    private $IntefaceAgenda;

    public function __construct(AgendaInterfaceRepository $agenda){
        $this->IntefaceAgenda = $agenda;
    }

    public function BuscarAgendas($Requests){

        $validacao = $this->ValidarBuscarAgendas($Requests);

        if($validacao->fails()){
            return response()->json([$validacao->errors(), Response::HTTP_BAD_REQUEST]);
        }

        return $this->IntefaceAgenda->BuscarAgendas($Requests);
    }

    public function SalvarAgendamento($Requests){

        if($this->BuscarAgendas($Requests)){
            return response()->json([
                "status"=>"false",
                "response"=>"Sala agendada para data e horario definido."
                ]);
        }

        $validacao = $this->ValidarAgendamento($Requests);

        if($validacao){
            return response()->json($validacao);
        }

    //    return $this->obj_banco->create($Requests->all());
    }

    public function BuscarAgendaCancelar($Requests){

        $validacao = $this->ValidarCancelamento($Requests);

        if($validacao){
            return response()->json($validacao);
        }

        // $cancelamentos = $this->obj_banco->query()->where([
        //     'status'=>1,
        //     'id_sala' => $Requests->json('id_sala'),
        //     'data_inicio'=>$Requests->json('data_inicio'),
        //     'email'=>$Requests->json('email')
        // ]);

        // return $cancelamentos;
    }

    public function CancelarAgendamentos($Requests){

        $cancelar = $this->BuscarAgendaCancelar($Requests);
        if(count($cancelar->get())==0){
            return response()->json([
                "status"=>"false",
                "response"=>"Nao foi encontrado agenda para cancelar."
                ]);
        }

        return ;
        // $cancelamentos = $this->obj_banco->query()     
        // ->where([
        //     'status'=>1,
        //     'id_sala' => $Requests->json('id_sala'),
        //     'data_inicio'=>$Requests->json('data_inicio'),
        //     'email'=>$Requests->json('email')
        // ])->update(['status'=>0]);

        // return $cancelamentos;
    }


    public function ListarAgendamentos($data){

        
        $validacao = $this->ValidarListarAgendamentos($data);

        if($validacao){
            return response()->json($validacao);
        }

        // $agendados = $this->obj_banco
        // ->where([
        //     'status'=>1,
        //     ["data_inicio",'like', $data.'%']
        // ])->get();

        // return $agendados;
    }
}