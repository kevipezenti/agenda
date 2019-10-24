<?php
    namespace App\Repositories;

use App\Models\Agenda;

class AgendaRepositories implements AgendaInterfaceRepository{

        private $obj_banco;

        public function __construct(Agenda $agenda){
            $this->obj_banco = $agenda;
        }

        public function BuscarAgendas($Requests){

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
            return $this->obj_banco->create($Requests->all());
        }

        public function BuscarAgendaCancelar($Requests){

            $cancelamentos = $this->obj_banco->query()->where([
                'status'=>1,
                'id_sala' => $Requests->json('id_sala'),
                'data_inicio'=>$Requests->json('data_inicio'),
                'email'=>$Requests->json('email')
            ]);
    
            return $cancelamentos;

        }

        public function CancelarAgendamentos($Requests){

            $cancelamentos = $this->obj_banco->query()     
        ->where([
            'status'=>1,
            'id_sala' => $Requests->json('id_sala'),
            'data_inicio'=>$Requests->json('data_inicio'),
            'email'=>$Requests->json('email')
        ])->update(['status'=>0]);

        return $cancelamentos;

        }
        
        public function ListarAgendamentos($data){

            $agendados = $this->obj_banco
        ->where([
            'status'=>1,
            ["data_inicio",'like', $data.'%']
        ])->get();

        return $agendados;

        }
    }