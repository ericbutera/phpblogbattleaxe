<?php
class postController extends baxe_App_Web_Controller_ActionAbstract {


    public function indexAction() {
        return $this->listAction();
    }


    public function listAction() {
        $layout = $this->getLayout();
        $layout->setPageTitle("Posts");
        $layout->addMeta(array('name'=>'description', 'content'=>"Diary of a madman"));

        $k = __FILE__.__FUNCTION__;
        if (!$r = apc_fetch($k)) {
            $postService = Blog_Post_Service::getInstance($this->app);

            $view = $this->getView();
            $view->posts = $postService->fetchLatest();
            $r = $view->render("blog/index.php");
            apc_store($k, $r, 60*10);
        }
        return $r;
    }


    public function viewAction() {
        try {
            $response = $this->getResponse();

            $postService = Blog_Post_Service::getInstance($this->app);
            if (!empty($_GET['slug'])) {
                $post = $postService->loadBySlug($_GET['slug']);
            } else {
                $post = $postService->load(isset($_GET['id']) ? (int)$_GET['id'] : 0);
            }

            $response->addHeader(new baxe_Header_Pingback($this->app->getConfig()->config['site.host'] ."/post/pingback"));

            $layout = $this->getLayout();
            $layout->setPageTitle($post->name);
            $layout->addMeta(array('name'=>'description', 'content'=>$post->teaser));

            $k = __FILE__.__FUNCTION__.$post->postId;
            if (!$r = apc_fetch($k)) {
                $view = $this->getView();
                $view->post = $post;
                $r = $view->render("blog/post.php");
                apc_store($k, $r, 60*10);
            }

            return $r;
        } catch (Exception $e) {
            $response->addHeader(new baxe_Header_404);
            $this->getLayout()->setPageTitle("Invalid Post.");
            $this->app->getFlash()->getError()->add("The post you requested does not exist.");
            return;
        }
    }


    public function rssAction() {
        $r = '';
        $this->getResponse()->addHeader(new baxe_Header_ContentType(
            baxe_Header_ContentType::XML, baxe_Header_ContentType::CHARSET_UTF8
        ));

        $k = __FILE__.__FUNCTION__;
        if (!$r = apc_fetch($k)) {
            $baseUrl = $this->app->getConfig()->config['site.host'];
            $rss = new Blog_RSS('Diary of a madman', $baseUrl, 'The trials and tribulations of a web developer.');
            $postGateway = new Blog_Post_Gateway($this->app);
            foreach ($postGateway->fetchLatest(15) as $post) {
                /* @var $post Blog_Post_VO */
                $rss->addItem(array(
                    'title'         => $post->name,
                    'link'          => $baseUrl . $post->getPermalink(),
                    'description'   => $post->teaser,
                    'pubDate'       => date(DATE_RSS, $post->createdTs),
                    'language'      => 'en'
                ));
            }
            $r = (string)$rss;
            apc_store($k, $r, 60*10);
        }

        return new baxe_Response_Content_String($r);
    }

    /**
     * Handle pingbacks.  This is an XMLRPC service.
     *
     * @return string
     */
    public function pingbackAction() {
        $this->getResponse()->addHeader(new baxe_Header_ContentType(
            baxe_Header_ContentType::XML, baxe_Header_ContentType::CHARSET_UTF8
        ));

        // TODO - log all xmlrpc input to a file
        $logger = new baxe_Logger(baxe_Logger_File::getInstance($this->app));
        $logger->info();

        $xml = trim(file_get_contents('php://input'));

        return new baxe_Response_Content_String($r);
    }

}
