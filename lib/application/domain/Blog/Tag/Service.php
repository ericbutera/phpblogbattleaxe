<?php
class Blog_Tag_Service {

    /**
     * @var baxe_App_Abstract
     */
    private $app;

    /**
     * @var Blog_Tag_Service
     */
    private static $instance;

    /**
     * @param baxe_App_Abstract $app
     */
    public function __construct(baxe_App_Abstract $app) {
        $this->app = $app;
    }

    /**
     * @return Blog_Post_Service
     */
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self(baxe_App::getInstance());
        }
        return self::$instance;
    }

    /**
     * Load a tag by name if it exists or create & save it, then return it.
     *
     * @param string $name
     * @return Blog_Tag_VO
     * @throws Exception
     */
    public function loadOrCreateByName($name) {
        $name = trim($name);
        try {
            return $this->loadByName($name);
        } catch (Exception $e) {}

        $gateway = new Blog_Tag_Gateway($this->app);
        return $gateway->create($name);
    }

    /**
     * Load a Blog_Tag_VO by its name
     *
     * @param string $tagName
     * @return Blog_Tag_VO
     * @throws Exception
     */
    public function loadByName($tagName) {
        $gateway = new Blog_Tag_Gateway($this->app);
        return $gateway->loadByName($tagName);
    }

    /**
     *
     * @param Blog_Post_VO $post
     * @return Iterator<Blog_Tag_VO>
     * @throws Exception
     */
    public function loadByPost(Blog_Post_VO $post) {
        $gateway = new Blog_Tag_Gateway($this->app);
        return $gateway->loadByPost($post);
    }

}
