# Desafio Técnico Full-stack

Processo seletivo - candidato Felipe Fornasier

## Funcionalidades da API

Cadastro de produtos

Movimentação de produtos

Histórico

## Tecnologias utilizadas

PHP 7.3

Laravel 6.2

MySQL 5.7

# Instalação

## Configuração inicial

composer install

cp .env.example .env

php artisan key:generate

Criar virtual host apontando para pasta public

## Create database

Name: appmax

Collation: utf8_general_ci

## Gerar tabelas

php artisan migrate

## Arquivo auxiliar para testes

Foi criado um Postman collection para auxiliar no testes da API. Está localizado no caminho storage/appmax.postman_collection.json 