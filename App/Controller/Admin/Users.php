<?php
    namespace App\Controller\Admin;
    use App\Utils\View;
    use App\Model\Entity\User as EntityUser;
    use WilliamCosta\DatabaseManager\Pagination;

    class Users extends Page{
        public static function getUsers($request){
            $content = View::render('admin/modules/users/index',[
                'itens' => self::getUsersItems($request, $obPagination),
                'pagination' =>parent::getPagination($request, $obPagination),
                'status' => self::getStatus($request)
            ]);

            return parent::getPanel('usuários', $content, 'Users');
        }
        
        private static function getUsersItems($request, &$obPagination){
            $itens = '';
            $quantidadeTotal = EntityUser::getUsers(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
            
            $queryParams = $request->getQueryParams();
            $paginaAtual = $queryParams['page'] ?? 1;
            
            $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 5);
            $results = EntityUser::getUsers(null, 'id DESC', $obPagination->getLimit());
            
            
            while ($obUser = $results->fetchObject(EntityUser::class)) {
                
                $itens .= View::render("admin/modules/users/item", [
                    'id' => $obUser->id,
                    'nome' => $obUser->nome,
                    'email' => $obUser->email
                ]);
            }
            return  $itens;
        }
        
        public static function getNewUser($request){
            $content = View::render('admin/modules/users/form',[
                'title' => 'Cadastrar usuário',
                'nome' => '',
                'email' => '',
                'status' => self::getStatus($request)
            ]);
            
            return parent::getPanel('Cadastrar usuário', $content, 'users');
        } 
        
        public static function setNewUser($request){
            $postVars = $request->getPostVars();
            $nome = $postVars['nome'] ?? '';
            $email = $postVars['email'] ?? '';
            $senha = $postVars['senha'] ?? '';
            // print_r($nome);
            // exit;

            $obUser = EntityUser::getUserByEmail($postVars['email']);
            
            if ($obUser instanceof EntityUser){
                $request->getRouter()->Redirect('/admin/users/new?status=duplicated');
            }

            $obUser = new EntityUser();
            $obUser->nome = $nome;
            $obUser->email = $email;
            $obUser->senha = password_hash($senha, PASSWORD_DEFAULT);
            $obUser->cadastrar();

            
            $request->getRouter()->Redirect('/admin/users/'.$obUser->id.'/edit?status=created');
        }

        public static function getEditUser($request, $id){
            $obUser = EntityUser::getUserById($id);
            if(!$obUser instanceof EntityUser){
                $request->getRouter()->redirect('/admin/users');
            }

            $content = View::render('admin/modules/users/form',[
                'title' => 'Editar usuário',
                'nome' => $obUser->nome,
                'email' => $obUser->email,
                'status' => self::getStatus($request)
            ]);

            return parent::getPanel('Editar usuário', $content, 'Users');
        }

        public static function setEditUser($request, $id){
            $postVars = $request->getPostVars();

            $obUser = EntityUser::getUserByEmail($postVars['email']);

            if ($obUser instanceof EntityUser && $obUser->id != $id){
                $request->getRouter()->Redirect('/admin/users/'.$id.'/edit?status=duplicated');
            }

            $obUser = EntityUser::getUserById($id);
            if(!$obUser instanceof EntityUser){
                $request->getRouter()->redirect('/admin/users');
            }


            $nome = $postVars['nome'] ?? '';
            $email = $postVars['email'] ?? '';
            $senha = $postVars['senha'] ?? '';

            $obUser->nome = $nome;
            $obUser->email = $email;
            $obUser->senha = password_hash($senha, PASSWORD_DEFAULT);

            $obUser->atualizar();

            $request->getRouter()->Redirect('/admin/users/'.$obUser->id.'/edit?status=updated');
        }

        private static function getStatus($request){
            $queryParams = $request->getQueryParams();

            if (isset($queryParams['status'])) {
                switch($queryParams['status']){
                    case 'created':
                        return Alert::getSuccess('usuário criado com sucesso!');
                    case 'updated':
                        return Alert::getSuccess('usuário atualizado com sucesso!');
                    case 'deleted':
                        return Alert::getError('usuário excluido com sucesso!');
                    case 'duplicated':
                        return Alert::getError('o email digitado já está em uso');
                    default:
                        return '';
                }
            }
        }

        public static function getDeleteUser($request, $id){
            $obUser = EntityUser::getUserById($id);

            if(!$obUser instanceof EntityUser){
                $request->getRouter()->redirect('/admin/users');
            }

            $content = View::render('admin/modules/users/delete',[
                'nome' => $obUser->nome,
                'email' => $obUser->email,
            ]);

            return parent::getPanel('Excluir usuário', $content, 'Users');    
        }
        
        public static function setDeleteUser($request, $id){
            $obUser = EntityUser::getUserById($id);
            
            if($obUser instanceof EntityUser){
                $obUser->excluir();
            }
            $request->getRouter()->Redirect('/admin/users?status=deleted');
        }
    }
