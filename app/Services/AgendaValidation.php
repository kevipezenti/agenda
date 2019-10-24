<?php

namespace App\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AgendaValidation{

    private $Allfields = [
        'id_sala' => 'required | integer',
        'email'=> 'required | email | max:50',
        'data_inicio'=> 'required | date_format:Y-m-d H:i:s',
        'data_fim'=> 'required | date_format:Y-m-d H:i:s',
        'status'=> 'int',
        'descricao'=> 'required | string',
    ];

    private $DataField = ['data'=> 'required | date_format:Y-m-d'];
    

    public function ValidarBuscarAgendas($request){

        $fields = [
            'id_sala'=>$this->Allfields['id_sala'],
            'data_inicio'=>$this->Allfields['data_inicio'],
            'data_fim'=>$this->Allfields['data_fim']
        ];

        $validacao = Validator::make($request->all(),$fields);

        return $validacao->fails() ? 
        [$validacao->errors(), Response::HTTP_BAD_REQUEST] : false;
    }

    public function ValidarAgendamento($request){

        $validacao = Validator::make($request->all(),
        $this->Allfields);

        return $validacao->fails() ? 
        [$validacao->errors(), Response::HTTP_BAD_REQUEST] : false;
    }


    public function ValidarCancelamento($request){

        $fields = [
            'id_sala'=>$this->Allfields['id_sala'],
            'data_inicio'=>$this->Allfields['data_inicio'],
            'email'=>$this->Allfields['email']
        ];

        $validacao = Validator::make($request->all(),$fields);

        return $validacao->fails() ? 
        [$validacao->errors(), Response::HTTP_BAD_REQUEST] : false;
    }

    public function ValidarListarAgendamentos($request){

        $validacao = Validator::make(['data'=>$request],$this->DataField);

        return $validacao->fails() ? 
        [$validacao->errors(), Response::HTTP_BAD_REQUEST] : false;
    }
}