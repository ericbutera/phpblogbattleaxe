<?php
class Blog_Post_SplashImageHandler extends baxe_Upload_HandlerAbstract {

    /**
     * @var baxe_App_Abstract
     */
    private $app;

    /**
     * @var Blog_Post_VO
     */
    private $post;

    public function __construct(baxe_App_Abstract $app, Blog_Post_VO $post) {
        $this->post  = $post;
        $this->app   = $app;
        $config = $this->app->getConfig()->config;

        if (!$post->postId) {
            throw new Exception("Post must be saved before it can handle uploads.");
        }

        $this->field = 'splashImage';
        $this->mimes = baxe_Upload::getImageMimes();

        $format = "%s/b/splash/%d";

        $this->url = sprintf($format,
            $config['site.host'],
            (int)$post->postId
        );

        $path = dirname(dirname($this->app->getConfig()->config['application.path'])) ."/wroot";
        $this->path = sprintf($format,
            $path,
            (int)$post->postId
        );
    }

    /**
     * @return Blog_Post_VO
     */
    public function getPost() {
        return $this->post;
    }

}
