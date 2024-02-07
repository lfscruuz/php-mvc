<?php

    Namespace App\Controller\Pages;
    use App\Utils\View;
    use App\Model\Entity\Organization;

    Class About extends Page{
        public static function getAbout(){
            $obOrganization = new Organization();
            $content = View::render("pages/about", [
                'name' => $obOrganization->name,
                'description' => $obOrganization->description,
                'site' => $obOrganization->site
            ]);

            return parent::getPage('SOBRE > PHP', $content);
        }
    }