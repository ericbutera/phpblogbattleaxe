<?php
class Blog_Post_Tag_Service {

    /**
     * @var baxe_App_Abstract
     */
    private $app;

    /**
     * @var Blog_Post_VO
     */
    private $post;

    /**
     * @var SplObjectStorage
     */
    private $tags;

    /**
     * @param baxe_App_Abstract $app
     * @param Blog_Post_VO $post
     */
    public function __construct(baxe_App_Abstract $app, Blog_Post_VO $post) {
        $this->app  = $app;
        $this->post = $post;
        $this->tags = new SplObjectStorage;
    }

    /**
     * @param Blog_Post_VO $post
     * @return Blog_Tag_Service
     */
    public static function getInstance(Blog_Post_VO $post) {
        return new self(baxe_App::getInstance(), $post);
    }

    /**
     * Load tags for this Post
     *
     * @return void
     * @throws Exception
     */
    public function load() {
        // $gateway = new Blog_Tag_Gateway($this->app);
        try {
            $tagService = Blog_Tag_Service::getInstance();
            foreach ($tagService->loadByPost($this->post) as $tag) {
                /* @var $tag Blog_Tag_VO */
                $this->tags->attach($tag);
            }
        } catch (Exception $e) {}
    }

    /**
     * Render the tags as a comma separated string
     *
     * @return string
     */
    public function asText() {
        $r = '';
        foreach ($this->tags as $tag) {
            /* @var $tag Blog_Tag_VO */
            $r .= $tag->name .", ";
        }
        $r = rtrim($r, ", ");
        return $r;
    }

    /**
     * Load tags from a string and create new tag records as necessary.
     *
     * @param string $string
     * @param string $separator Optional separator character, defaults to comma
     * @return void
     * @throws Exception
     */
    public function loadFromString($string, $separator=",") {
        $tags = explode($separator, $string);
        if (!count($tags)) {
            return;
        }

        $tagService = Blog_Tag_Service::getInstance();

        foreach ($tags as $tag) {
            $tag = trim($tag);
            $this->tags->attach($tagService->loadOrCreateByName($tag));
        }
    }

    /**
     * Delete all Tag joins associated with this Post
     *
     * @return void
     * @throws Exception
     */
    public function delete() {
        $gateway = new Blog_Post_Tag_Gateway($this->app);
        $gateway->deleteByPost($this->post);
    }

    /**
     * Save Tags to this Post
     *
     * @return void
     * @throws Exception
     */
    public function save() {
        $this->delete();

        $gateway = new Blog_Post_Tag_Gateway($this->app);
        foreach ($this->tags as $tag) {
            /* @var $tag Blog_Tag_VO */
            $vo = new Blog_Post_Tag_VO;
            $vo->postId = $this->post->postId;
            $vo->tagId  = $tag->tagId;
            $gateway->save($vo);
        }
    }

}
