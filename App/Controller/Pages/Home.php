<?php

    Namespace App\Controller\Pages;
    use App\Utils\View;
    Class Home{
        public static function getHome(){
            return View::render("pages/home");
        }
    }