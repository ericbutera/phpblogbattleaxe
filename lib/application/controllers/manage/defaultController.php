<?php
class manage_defaultController extends AuthenticationController {

	public function indexAction() {
		$this->app->getLayout()->setPageTitle("Manage");

		$view = $this->getView();
        return $view->render("manage/index.php");
	}

}
