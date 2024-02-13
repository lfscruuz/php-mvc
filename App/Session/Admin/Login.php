<?php

    namespace App\Session\Admin;

    class login{

        private static function init(){
            if(session_status() != PHP_SESSION_ACTIVE){
                session_start();
            }
        }
        public static function login($obUser){

            SELF::init();

            $_SESSION['admin']['usuario'] = [
                'id' => $obUser->id,
                'nome' =>$obUser->nome,
                'email' =>$obUser->email
            ];

            return true;

            // echo "<pre>";
            // print_r($obUser);
            // echo "</pre>";
            // exit;
        }

        public static function logout(){
            self::init();

            unset($_SESSION['admin']['usuario']);
        }

        public static function isLogged(){
            self::init();
            return isset($_SESSION['admin']['usuario']['id']);
        }
    }