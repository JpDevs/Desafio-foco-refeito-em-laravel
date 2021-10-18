<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $table = "reservas";
    public $timestamps = false;
    protected $fillable = [
        'n_reserva',
        'nome_cliente',
        'cliente_email',
        'cliente_telefone',
        'checkin',
        'checkout',
        'status_reserva',
        'criancas',
        'adultos'

    ];

}
