<?php
    namespace App\Controller\Admin;
    use App\Utils\view;

    class Page{
        private static $modules = [
            'home' =>[
                'label' => 'HOME',
                'link' => URL.'/admin'
            ],
            'testimony' =>[
                'label' => 'DEPOIMENTOS',
                'link' => URL.'/admin/testimonies'
            ],
            'users' =>[
                'label' => 'USUÁRIOS',
                'link' => URL.'/admin/users'
            ],
        ];

        public static function getPage($title, $content){
            return view::render('admin/page', [
                'title' =>$title,
                'content' =>$content
            ]);
        }

        public static function getPanel($title, $content, $currentModule){
            $contentPanel = view::render('admin/panel', [
                'menu' => self::getMenu($currentModule),
                'content' =>$content
            ]);

            return self::getPage($title, $contentPanel);
        }

        private static function getMenu($currentModule){
            $links = '';

            foreach(self::$modules as $hash=>$module){
                $links .= View::render('admin/menu/link', [
                    'label' => $module['label'],
                    'link' => $module['link'],
                    'current' => $hash == $currentModule ? 'text-danger' : ''
                ]);
            }

            return View::render('admin/menu/box',[
                'links' => $links
            ]);
        }

        public static function getPagination($request, $obPagination){
            $pages = $obPagination->getPages();

            
            if (count($pages) <= 0){
                return '';
            }
            
            $links = '';
            $url = $request->getRouter()->getCurrentUrl();
            $queryParams = $request->getQueryParams();

            foreach($pages as $page){
                $queryParams['page'] = $page['page'];
                $link = $url.'?'.http_build_query($queryParams);
                $links .= View::render('admin/pagination/link', [
                    'page' => $page['page'],
                    'link' =>$link,
                    'active' => $page['current'] ? 'active' : ''
                ]);
            }
            return View::render('admin/pagination/box', [
                'links' => $links
            ]);
            
            // echo "<pre>";
            // print_r($link);
            // echo "</pre>";
            // exit;

        }
    }