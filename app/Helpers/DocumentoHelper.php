<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class DocumentoHelper 
{
    public static function temSeparadores(string $documento): bool 
    {
        return Str::contains($documento, ['.', '-', '/']);
    }

    public static function removerSeparadores(string $documento): string 
    {
        return Str::remove( ['.', '-', '/'], $documento);
    }
}