<?php

    Namespace App\Controller\Pages;
    use App\Utils\View;

    Class Testimony extends Page{
        public static function getTestimonies(){

            $content = View::render("pages/testimonies", [
                
            ]);

            return parent::getPage('DEPOIMENTOS', $content);
        }
    }