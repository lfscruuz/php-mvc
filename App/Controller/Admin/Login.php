<?php
    namespace App\Controller\Admin;
    use App\Model\Entity\User;
    use App\Utils\view;
    use App\Session\Admin\login as SessionAdminLogin;

    class Login extends Page{
        public static function getLogin($request, $errorMessage = null){

            $status = !is_null($errorMessage) ? view::render('admin/login/status', [
                'mensagem' => $errorMessage
            ]) : '';

            $content = view::render('admin/login', [
                'status' => $status
            ]);

            return parent::getPage('Login', $content);
        }

        public static function setLogin($request){
            $postVars = $request->getPostVars();
            $email = $postVars['email'] ?? '';
            $senha = $postVars['senha'] ?? '';

            $obUser = User::getUserByEmail($email);
            if(!$obUser instanceof User){
                return self::getLogin($request, 'email ou senha incorretos');
            }
            
            if(!password_verify($senha, $obUser->senha)){
                return self::getLogin($request, 'email ou senha incorretos');
            }
            
            SessionAdminLogin::login($obUser);
            
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            // exit;
            
            $request->getRouter()->redirect('/admin');
        }
    }
