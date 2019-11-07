<?php
    namespace App\Repositories;

use App\Models\agenda;

class agendaRepository {

        private $objBanco;

        public function __construct(agenda $agenda){
            $this->objBanco = $agenda;
        }

        public function buscarAgendas($requests){

            $agendados = $this->objBanco->query()->where([
                'status'=>1,
                'id_sala'=>$requests->json('id_sala'),
                ['data_inicio','>=',$requests->json('data_inicio')],
                ['data_inicio','<=',$requests->json('data_fim')],
                ['data_fim','>=',$requests->json('data_inicio')],
                ['data_fim','<=',$requests->json('data_fim')]
            ])->get();
        
            return $agendados;
        }

        public function salvarAgendamento($requests){
            return $this->objBanco->create($requests);
        }

        public function buscarAgendaCancelar($requests){

            $cancelamentos = $this->objBanco->query()->where([
                'status'=>1,
                'id_sala' => $requests->json('id_sala'),
                'data_inicio'=>$requests->json('data_inicio'),
                'email'=>$requests->json('email')
            ]);
    
            return $cancelamentos;

        }

        public function cancelarAgendamentos($requests){

            $cancelamentos = $this->objBanco->query()->where([
                'status'=>1,
                'id_sala' => $requests->json('id_sala'),
                'data_inicio'=>$requests->json('data_inicio'),
                'email'=>$requests->json('email')
            ])->update(['status'=>0]);

            return $cancelamentos;

        }
        
        public function listarAgendamentos($data){

            $agendados = $this->objBanco->where([
                'status'=>1,
                ["data_inicio",'like', $data.'%']
            ])->get();

            return $agendados;

        }
    }