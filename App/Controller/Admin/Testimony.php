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
        
        public static function getNewTestimony($request){
            $content = View::render('admin/modules/testimonies/form',[
                'title' => 'Cadastrar depoimento',
                'nome' => '',
                'mensagem' => ''
            ]);
            
            return parent::getPanel('Cadastrar depoimento', $content, 'testimony');
        } 
        
        public static function setNewTestimony($request){
            $postVars = $request->getPostVars();

            $obTestimony = new EntityTestimony;
            $obTestimony->nome = $postVars['nome'] ?? '';
            $obTestimony->mensagem = $postVars['mensagem'] ?? '';
            $obTestimony->cadastrar();

            
            $request->getRouter()->Redirect('admin/testimony/'.$obTestimony->id.'/edit?status=created');
        }

        public static function getEditTestimony($request, $id){
            $obTestimony = EntityTestimony::getTestimonyById($id);
            // print_r($obTestimony);
            // exit;
            if(!$obTestimony instanceof EntityTestimony){
                $request->getRouter()->redirect('/admin/testimonies');
            }

            $content = View::render('admin/modules/testimonies/form',[
                'title' => 'Editar depoimento',
                'nome' => $obTestimony->nome,
                'mensagem' => $obTestimony->mensagem
            ]);
            
            // echo "<pre>";
            // print_r($obTestimony);
            // echo "</pre>"; exit;

            return parent::getPanel('Editar depoimento', $content, 'testimony');
        }

        public static function setEditTestimony($request, $id){
            $obTestimony = EntityTestimony::getTestimonyById($id);
            // print_r($obTestimony);
            // exit;
            if(!$obTestimony instanceof EntityTestimony){
                $request->getRouter()->redirect('/admin/testimonies');
            }

            $postVars = $request->getPostVars();
            $obTestimony->nome = $postVars['nome'] ?? $obTestimony->nome;
            $obTestimony->mensagem = $postVars['mensagem'] ?? $obTestimony->mensagem;
            $obTestimony->atualizar();

            $request->getRouter()->Redirect('/admin/testimony/'.$obTestimony->id.'/edit?status=eupdated');
        }
    }
