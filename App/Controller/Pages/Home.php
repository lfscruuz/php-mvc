<?php

    Namespace App\Controller\Pages;
    use App\Utils\View;
    use App\Model\Entity\Organization;

    Class Home extends Page{
        public static function getHome(){
            $obOrganization = new Organization();
            $content = View::render("pages/home", [
                'name' => $obOrganization->name,
                'description' => $obOrganization->description,
                'site' => $obOrganization->site
            ]);

            return parent::getPage('MVC - TESTE - PHP', $content);
        }
    }