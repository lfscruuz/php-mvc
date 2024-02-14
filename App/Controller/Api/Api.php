<?php

namespace App\Controller\Api;
use WilliamCosta\DatabaseManager\Pagination;

class Api{
    public static function getDetails($request){
        return [
            'nome' => 'API - MVC',
            'versao' => 'v1.0.0',
            'autor'=> 'Luis',
            'email' => 'email@email.com'
        ];
    }

    protected static function getPagination($request, $obPagination){
        $queryParams = $request->getQueryParams();
        $pages = $obPagination->getPages();
        return [
            'paginaAtual' => isset($queryParams['page']) ? $queryParams['page'] :1,
            'quantidadePaginas' =>!empty($pages) ? count($pages) :1
        ];
    } 
}