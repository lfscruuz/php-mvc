<?php

    Namespace App\Controller\Pages;
    use App\Utils\View;
    use App\Model\Entity\Testimony as EntityTestimony;

    Class Testimony extends Page{
        private static function getTestimonyItems(){
            $results = EntityTestimony::getTestimonies(null, 'id DESC');
            
            // echo "<pre>";
            // print_r($results);
            // echo "</pre>";
            // exit;
            
            
            while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {
                //$obtTestimony DEVERIA ser uma array, mas está retornando somente a última linha inserida na tabela. $results está fazendo a consulta correta, o problema está em fetch(object(EntityTestimony::class))
                
                // echo "<pre>";
                // print_r($obTestimony);
                // echo "</pre>";
                // exit;
                
                $content = View::render("pages/testimony/item", [
                    'nome' => $obTestimony->nome,
                    'mensagem' => $obTestimony->mensagem,
                    'data' => date('d/m/Y H:i:s', strtotime($obTestimony->data))
                ]);
            }
            return $content;
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