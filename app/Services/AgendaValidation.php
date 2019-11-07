<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class agendaValidation{

    private static $allfields = [
        'id_sala' => 'required | integer',
        'email'=> 'required | email | max:50',
        'data_inicio'=> 'required | date_format:Y-m-d H:i:s',
        'data_fim'=> 'required | date_format:Y-m-d H:i:s',
        'status'=> 'int',
        'descricao'=> 'required | string',
    ];

    private static $dataField = ['data'=> 'required | date_format:Y-m-d'];
 
    public static function validarAgendamento($request){

        return Validator::make($request->all(), self::$allfields);

    }

    public static function validarCancelamento($request){

        $fields = [
            'id_sala'=>self::$allfields['id_sala'],
            'data_inicio'=>self::$allfields['data_inicio'],
            'email'=>self::$allfields['email']
        ];

        return Validator::make($request->all(),$fields);

    }

    public static function validarListarAgendamentos($request){

        return Validator::make(['data'=>$request], self::$dataField);

    }
}