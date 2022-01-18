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
     * Criar produto
     *
     * Cria o produto de acordo com os parâmetros passados
     *
     * @param   sku                 string      Identificador, logística de armazém. ex: CEL-S-S8-P-128
     * @param   nome                string      Nome do produto. ex: Samsung Galaxy S8 Preto
     * @param   quantidade_inicial  int         Quantidade inicial no estoque do produto
     */
    public function criar(Request $request) {
        // Validação dos campos
        $this->validate($request, [
            'sku'                   => 'required',
            'nome'                  => 'required',
            'quantidade_inicial'    => 'required'
        ]);

        $retorno = $this->service->criar($request->all());
        return response()->json($retorno);
    }

    /**
     * Adicionar estoque
     *
     * Adiciona estoque ao um produto e gera seu histórico de movimentação
     *
     * @param   sku             string      Identificador, logística de armazém. ex: CEL-S-S8-P-128
     * @param   quantidade      int         Quantidade a ser adicionada ao estoque do produto
     */
    public function adicionar(Request $request, $id) {
        // Validação dos campos
        $this->validate($request, [
            'quantidade'    =>  'required'
        ]);

        $retorno = $this->service->adicionar($id, $request->all());
        return response()->json($retorno);
    }

    /**
     * Remove estoque
     *
     * Faz a baixa de uma quantia do estoque de um produto e gera seu histórico de movimentação
     * Caso não haja a quantia o suficiente para baixa, retorna mensagem informativa
     *
     * @param   sku             string      Identificador, logística de armazém. ex: CEL-S-S8-P-128
     * @param   quantidade      int         Quantidade a ser removida ao estoque do produto
     */
    public function remover(Request $request, $id) {
        //Validação de campos
        $this->validate($request, [
            'quantidade'    =>  'required'
        ]);

        $retorno = $this->service->remover($id, $request->all());
        return response()->json($retorno);
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
