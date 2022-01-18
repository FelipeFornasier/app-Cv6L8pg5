<?php

namespace App\Services;

// Carregamento dos models
use App\Models\Produto as Produto;
use App\Models\ProdutoMovimento as ProdutoMovimento;

class ProdutoService {

    public function criar($dados) {
        try {
            // Seta quantidade atual
            $dados['quantidade_atual'] = $dados['quantidade_inicial'];
            // Armazena na base
            $produto = Produto::create($dados);

            // Retorna o produto e status code 201 created
            return [
                'code' => 201,
                'produto' => $produto
            ];
        } catch(\Illuminate\Database\QueryException $e) {
            // Retorna status code 500 Internal server error
            return [
                'code' => 500,
                'message' => 'Ocorreu um erro ao cadastrar o produto, identificador sku duplicado'
            ];
        } catch(Exception $e){
            // Retorna status code 500 Internal server error
            return [
                'code' => 500,
                'message' => 'Ocorreu um erro ao cadastrar o produto'
            ];
        }
    }
    
    public function adicionar($id, $dados) {
        try {
            // Busca o produto
            $produto = Produto::findOrFail($id);

            // Adiciona os produtos na quantidade atual
            $dados['quantidade_atual'] = $produto->quantidade_atual + $dados['quantidade'];

            // Dados movimento
            $movimento = new ProdutoMovimento();
            $movimento->sku = $produto->sku;
            $movimento->quantidade = $dados['quantidade'];
            $movimento->tipo = 'adição';

            // Transaction para certificar que os dois campos salvam juntos ou nenhum salva
            \DB::transaction(function () use ($produto, $dados, $movimento) {
                // Persistência produto
                $produto->update($dados);
                // Persistência movimento
                $movimento->save();
            });

            // Retorna status code 200 OK
            return [
                'code' => 200,
                'message' => 'Reposição de estoque do produto realizada com sucesso!'
            ];
        } catch (\Exception $e) {
            // Retorna status code 500 Internal server error
            return [
                'code' => 500,
                'message' => 'Ocorreu um erro ao tentar efetuar a reposição de estoque do produto.'
            ];
        }
    }

    public function historico() {
        try {
            // Retorna movimento dos produtos ordenados por data descrescente
            return [
                'code'      =>  '200',
                'movimento' =>  ProdutoMovimento::orderBy('data_hora', 'desc')->get()
            ];
        } catch (Exception $e) {
            // Retorna status code 500 Internal server error
            return [
                'code' => 500,
                'message' => 'Ocorreu um erro ao tentar buscar histórico'
            ];
        }
    }

}
