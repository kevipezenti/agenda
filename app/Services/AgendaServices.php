<?php

namespace App\Services;

use App\Models\Agenda;


class AgendaServices extends AgendaValidation{

    private $obj_banco;

    public function __construct(Agenda $agenda){
        $this->obj_banco = $agenda;
    }

    public function BuscarAgendas($Requests){

        $validacao = $this->ValidarBuscarAgendas($Requests);

        if($validacao){
            return response()->json($validacao);
        }

        $agendados = $this->obj_banco->query()->where([
                'status'=>1,
                'id_sala'=>$Requests->json('id_sala'),
                ['data_inicio','>=',$Requests->json('data_inicio')],
                ['data_inicio','<=',$Requests->json('data_fim')],
                ['data_fim','>=',$Requests->json('data_inicio')],
                ['data_fim','<=',$Requests->json('data_fim')]
            ])->get();
        
        return count($agendados)!=0;
    }

    public function SalvarAgendamento($Requests){

        $validacao = $this->ValidarAgendamento($Requests);

        if($validacao){
            return response()->json($validacao);
        }

       return $this->obj_banco->create($Requests->all());
    }

    public function BuscarAgendaCancelar($Requests){

        $validacao = $this->ValidarCancelamento($Requests);

        if($validacao){
            return response()->json($validacao);
        }

        $cancelamentos = $this->obj_banco->query()->where([
            'status'=>1,
            'data_inicio'=>$Requests->json('data_inicio'),
            'email'=>$Requests->json('email')
        ])->get();

        return count($cancelamentos)==0;
    }

    public function CancelarAgendamentos($Requests){
        $cancelamentos = $this->obj_banco->query()     
        ->where([
            'status'=>1,
            'data_inicio'=>$Requests->json('data_inicio'),
            'email'=>$Requests->json('email')
        ])->update(['status'=>0]);

        return $cancelamentos;
    }


    public function ListarAgendamentos($data){

        
        $validacao = $this->ValidarListarAgendamentos($data);

        if($validacao){
            return response()->json($validacao);
        }

        $agendados = $this->obj_banco
        ->where([
            'status'=>1,
            ["data_inicio",'like', $data.'%']
        ])->get();

        return $agendados;
    }
}