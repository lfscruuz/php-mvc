<?php
    namespace App\Controller\Admin;
    use App\Utils\view;

    class Page{
        public static function getPage($title, $content){
            return view::render('admin/page', [
                'title' =>$title,
                'content' =>$content
            ]);
        }
    }