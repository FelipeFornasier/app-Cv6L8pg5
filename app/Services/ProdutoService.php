<?php

namespace App\Services;

// Carregamento dos models
use App\Models\Produto as Produto;
use App\Models\ProdutoMovimento as ProdutoMovimento;

class ProdutoService {

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
