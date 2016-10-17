<?php
class sitemapController extends baxe_App_Web_Controller_ActionAbstract {

    public function xmlAction() {
        $r = '';
        $this->getResponse()->addHeader(new baxe_Header_ContentType(
            baxe_Header_ContentType::XML, baxe_Header_ContentType::CHARSET_UTF8
        ));

        $k = __FILE__.__FUNCTION__;
        if (!$r = apc_fetch($k)) {
            $v = $this->getView();
            $v->baseUrl = $this->app->getConfig()->config['site.host'];
            $r = $v->render("sitemap/xml.php");
            apc_store($k, $r, 60*10);
        }

        return new baxe_Response_Content_String($r);
    }

}
