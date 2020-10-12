<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $table = 'contactos';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'foto',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
