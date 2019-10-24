<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class AgendaValidation{

    private static $Allfields = [
        'id_sala' => 'required | integer',
        'email'=> 'required | email | max:50',
        'data_inicio'=> 'required | date_format:Y-m-d H:i:s',
        'data_fim'=> 'required | date_format:Y-m-d H:i:s',
        'status'=> 'int',
        'descricao'=> 'required | string',
    ];

    private static $DataField = ['data'=> 'required | date_format:Y-m-d'];
 
    public static function ValidarAgendamento($request){

        return Validator::make($request->all(), self::$Allfields);

    }

    public static function ValidarCancelamento($request){

        $fields = [
            'id_sala'=>self::$Allfields['id_sala'],
            'data_inicio'=>self::$Allfields['data_inicio'],
            'email'=>self::$Allfields['email']
        ];

        return Validator::make($request->all(),$fields);

    }

    public static function ValidarListarAgendamentos($request){

        return Validator::make(['data'=>$request], self::$DataField);

    }
}