<?php

namespace App\Http\Resources\Erros;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FalhaNaValidacaoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => $this['message'],
            'errors' => $this['errors'],
        ];
    }
}
