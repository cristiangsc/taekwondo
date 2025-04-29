<?php

namespace App\Enums;

enum MetodoPago: string
{
    case Efectivo = 'Efectivo';
    case Transferencia_bancaria = 'Transferencia bancaria';
    case Otro = 'Otro';
}
