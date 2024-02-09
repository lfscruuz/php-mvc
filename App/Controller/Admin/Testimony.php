<?php
    namespace App\Controller\Admin;
    use App\Utils\View;
    use App\Model\Entity\Testimony as EntityTestimony;
    use WilliamCosta\DatabaseManager\Pagination;

    class testimony extends Page{
        public static function getTestimonies($request){
            $content = View::render('admin/modules/testimonies/index',[
                'itens' => self::getTestimonyItems($request, $obPagination),
                'pagination' =>parent::getPagination($request, $obPagination),
            ]);

            return parent::getPanel('depoimentos', $content, 'testimony');
        }

        private static function getTestimonyItems($request, &$obPagination){
            $itens = '';
            $quantidadeTotal = EntityTestimony::getTestimonies(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

            
            $queryParams = $request->getQueryParams();
            $paginaAtual = $queryParams['page'] ?? 1;
            
            $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 5);
            $results = EntityTestimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());
            
            // echo "<pre>";
            // print_r($obPagination);
            // echo "</pre>"; exit;
            
            
            while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {
                
                $itens .= View::render("admin/modules/testimonies/item", [
                    'id' => $obTestimony->id,
                    'nome' => $obTestimony->nome,
                    'mensagem' => $obTestimony->mensagem,
                    'data' => date('d/m/Y H:i:s', strtotime($obTestimony->data)),

                ]);
                
                
            }
            return  $itens;
        }
    }
