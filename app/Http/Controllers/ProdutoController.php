<?php

namespace App\Http\Controllers;

// Biblioteca para requisições orientadas a objetos
use Illuminate\Http\Request;

// Biblioteca para validação de campos
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

// Chamada dos services onde contém a implementação da lógica
use App\Services\ProdutoService;

class ProdutoController extends Controller {

    protected $service;

    public function __construct(ProdutoService $service)
    {
        $this->service = $service;
    }

    /**
     * Histórico
     *
     * Retorna histórico de movimentações do estoque dos produtos
     *
     */
    public function historico(Request $request) {
        $retorno = $this->service->historico();
        return response()->json($retorno);
    }
}
