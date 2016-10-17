<?php
class contactController extends baxe_App_Web_Controller_ActionAbstract {


    public function indexAction() {
        $this->app->getLayout()->setPageTitle("If you'd like a word with me…");
        return $this->getView()->render("contact/index.php");
    }

}
