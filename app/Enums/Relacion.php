<?php
namespace App\Enums;

enum Relacion: string
{
    case Padre = 'Padre';
    case Madre = 'Madre';
    case Tutor = 'Tutor';
    case Otro = 'Otro';
}
