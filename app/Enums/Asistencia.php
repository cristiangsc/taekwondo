<?php
namespace App\Enums;

enum Asistencia: string
{
    case Presente = 'Presente';
    case Ausente = 'Ausente';
    case Justificado = 'Justificado';
}
