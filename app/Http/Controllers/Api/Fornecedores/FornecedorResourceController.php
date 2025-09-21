<?php

namespace App\Http\Controllers\Api\Fornecedores;

use App\Exceptions\Documento\CnpjJaCadastradoException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Fornecedores\CriarFornecedorRequest;
use App\Http\Requests\Fornecedores\ListarFornecedoresRequest;
use App\Http\Resources\Erros\FalhaNaValidacaoResource;
use App\Http\Resources\Fornecedores\FornecedorResource;
use App\Services\Fornecedores\Contratos\BuscadorDeFornecedorServiceInterface;
use App\Services\Fornecedores\Contratos\CriadorDeFornecedorServiceInterface;
use Illuminate\Http\JsonResponse;

class FornecedorResourceController extends Controller
{
    public function listar(
        ListarFornecedoresRequest $request,
        BuscadorDeFornecedorServiceInterface $buscadorDeFornecedorService,
    ): JsonResponse {
        $fornecedores = $buscadorDeFornecedorService
            ->busqueMuitosFiltrandoEOrdernando($request->validated());
        
        return FornecedorResource::collection($fornecedores)
            ->response();
    }
    
    public function salvar(
        CriarFornecedorRequest $request,
        CriadorDeFornecedorServiceInterface $criadorDeFornecedorService,
    ): JsonResponse {
        try {
            $fornecedor = $criadorDeFornecedorService
                ->criar($request->validated());
        } catch (CnpjJaCadastradoException $ex) {
            return new FalhaNaValidacaoResource([
                'message' => $ex->getMessage(),
                'errors' => [
                    'cnpj' => [$ex->getMessage()]
                ],
            ])
                ->response()
                ->setStatusCode(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        return new FornecedorResource($fornecedor)
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }
}
