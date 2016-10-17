<?php
class accountController extends baxe_App_Web_Controller_ActionAbstract {

	public function loginAction() {

	    $c = !empty($_GET['c']) ? $_GET['c'] : '/';

	    $request = $this->app->getRequest();
        if (baxe_App_Web_Request::POST === $request->getMethod()) {
            try {
                $auth = $this->app->getAuthentication();
                $auth->login( $auth->getAuthenticationVO($request->getPost()) );
                return $this->controller->redirectToRoute($c);
            } catch (Exception $e) {
                // TODO handle errors
                // $this->app->getError()->add('wtf');
            }
        }

		$this->app->getLayout()->setPageTitle("Login");
		$view = $this->getView();
		$view->c = $c;
        return $view->render("account/login.php");
	}

	public function logoutAction() {
	    $this->app->getAuthentication()->reset();
	    $this->app->getSession()->destroy();
	    return $this->controller->redirectToRoute("/");
	}

}
