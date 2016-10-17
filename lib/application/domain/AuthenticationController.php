<?php
class AuthenticationController extends baxe_App_Web_Controller_ActionAbstract {

    public function preDispatch() {
        if (!$this->app->getAuthentication()->isValid()) {
            $route = $this->controller->getRouter()->getRoute();
            $this->controller->redirectToRoute("/account/login", array("c"=>$route));
            die(__FILE__);
            // $this->controller->redirect("/account/login");
            // return $this->controller->forward("/account/login");
        }
    }

}