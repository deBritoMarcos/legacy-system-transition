<?php

namespace App\Exceptions\Documento;

use Exception;
use Illuminate\Http\Response;

class CnpjJaCadastradoException extends Exception
{
    public function __construct(
        ?string $mensagem = null,
        int $status = Response::HTTP_UNPROCESSABLE_ENTITY,
    ) {
        $feedback = empty($mensagem)
            ? __('validation.cnpj.already-exists', ['attribute' => 'cnpj'])
            : $mensagem;

        parent::__construct($feedback, $status);
    }


}
