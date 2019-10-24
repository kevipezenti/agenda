<?php
    namespace App\Repositories;

    use App\Models\Agenda;

    interface AgendaInterfaceRepository{

        public function __construct(Agenda $agenda);

        public function BuscarAgendas($Requests);

        public function SalvarAgendamento($Requests);

        public function BuscarAgendaCancelar($Requests);

        public function CancelarAgendamentos($Requests);
        
        public function ListarAgendamentos($data);

    }