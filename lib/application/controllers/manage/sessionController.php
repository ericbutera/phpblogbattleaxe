<?php
class manage_sessionController extends baxe_App_Web_Controller_ActionAbstract {
    public function indexAction() {
        ob_start();
        $this->app->getSession();
        var_dump($_SESSION);
        return ob_get_clean();
    }
}
