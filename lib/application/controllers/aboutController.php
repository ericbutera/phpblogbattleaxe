<?php
class aboutController extends baxe_App_Web_Controller_ActionAbstract {


    public function indexAction() {
        $this->app->getLayout()->setPageTitle("Some information about me…");
        return $this->getView()->render("about/index.php");
    }

}
