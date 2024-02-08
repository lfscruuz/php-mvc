<?php
    namespace App\Controller\Admin;
    use App\Model\Entity\User;
    use App\Utils\view;

    class Status extends Page{
        public static function getLogin($request){
            $content = view::render('admin/login', []);

            return parent::getPage('Login', $content);
        }
    }
