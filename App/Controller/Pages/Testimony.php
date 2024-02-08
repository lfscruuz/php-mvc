<?php

    Namespace App\Controller\Pages;
    use App\Utils\View;
    use App\Model\Entity\Testimony as EntityTestimony;
    use WilliamCosta\DatabaseManager\Database;

    Class Testimony extends Page{
        private static function getTestimonyItems($request){
            $itens = '';
            $quantidadeTotal = EntityTestimony::getTestimonies(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

            $queryParams = $request->getQueryParams();
            $paginaAtual = $queryParams['page'] ?? 1;
            
            //Classe que nunca foi apresentada antes?? acho que deveria estar inclusa em WilliamCosta\DatabaseManager\Database, mas não está encontrando...
            $obPagination = new Pagination($quantidadeTotal. $paginaAtual, 1);

            // echo "<pre>";
            // print_r($paginaAtual);
            // echo "</pre>";
            // exit;

            $results = EntityTestimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());
            while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {
                
                
                //$itens está retornando apenas a ultima linha na tabela, todo o resto ok
                //ERA .= PONTO IGUAL

                $itens .= View::render("pages/testimony/item", [
                    'nome' => $obTestimony->nome,
                    'mensagem' => $obTestimony->mensagem,
                    'data' => date('d/m/Y H:i:s', strtotime($obTestimony->data))
                ]);
                
                
            }
            return  $itens;
        }
        public static function getTestimonies($request){

            $content = View::render("pages/testimonies", [
                'itens' => self::getTestimonyItems($request),
            ]);

            return parent::getPage('DEPOIMENTOS', $content);
        }

        public static function insertTestimony($request){
            $postvars = $request->getPostVars();
            $obTestimony = new EntityTestimony();

            $obTestimony->nome = $postvars['nome'];
            $obTestimony->mensagem = $postvars['mensagem'];
            $obTestimony->cadastrar();
            return self::getTestimonies($request);
        }
    }