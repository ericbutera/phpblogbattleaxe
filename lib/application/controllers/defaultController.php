<?php
class defaultController extends baxe_App_Web_Controller_ActionAbstract {

	public function indexAction() {
	    $layout = $this->getLayout();
        $layout->setPageTitle("Eric Butera!");
        $layout->addMeta(array('name'=>'description', 'content'=>"Diary of a madman"));

        $k = md5(__FILE__.__FUNCTION__.__LINE__);
		if (!$r = apc_fetch($k)) {
            $postService = Blog_Post_Service::getInstance($this->app);

            $view = $this->getView();
            $view->posts = $postService->fetchLatest();
            $r = $view->render("blog/index.php");
            apc_store($k, $r, 60*10);
		}

		return $r;
	}

}
