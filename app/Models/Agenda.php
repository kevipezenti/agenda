<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model{
	
	protected $table = 'agenda';

	protected $fillable = [
		'id_sala',
		'email',
		'data_inicio',
		'data_fim',
		'status',
		'descricao'
	];

	protected $casts = [
		'data_inicio' => 'Timestamp',
		'data_fim' => 'Timestamp'
	];

	public $timestamps = false;
}