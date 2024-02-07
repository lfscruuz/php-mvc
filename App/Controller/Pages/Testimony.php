<?php

    Namespace App\Controller\Pages;
    use App\Utils\View;
    use App\Model\Entity\Testimony as EntityTestimony;

    Class Testimony extends Page{
        private static function getTestimonyItems(){
            $itens = '';
            $results = EntityTestimony::getTestimonies(null, 'id DESC');
            while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {
                
                
                //$itens está retornando apenas a ultima linha na tabela, todo o resto ok
                $itens .= View::render("pages/testimony/item", [
                    'nome' => $obTestimony->nome,
                    'mensagem' => $obTestimony->mensagem,
                    'data' => date('d/m/Y H:i:s', strtotime($obTestimony->data))
                ]);
                
                
                // echo "<pre>";
                // print_r($itens);
                // echo "</pre>";
            }
            return  $itens;
        }
        public static function getTestimonies(){

            $content = View::render("pages/testimonies", [
                'itens' => self::getTestimonyItems(),
            ]);

            return parent::getPage('DEPOIMENTOS', $content);
        }

        public static function insertTestimony($request){
            $postvars = $request->getPostVars();
            $obTestimony = new EntityTestimony();

            $obTestimony->nome = $postvars['nome'];
            $obTestimony->mensagem = $postvars['mensagem'];
            $obTestimony->cadastrar();
            return self::getTestimonies();
        }
    }