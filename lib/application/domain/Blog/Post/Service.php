<?php
class Blog_Post_Service {

    /**
     * @var Blog_Post_Service
     */
    private static $instance;

    /**
     * @var baxe_App_Abstract
     */
    private $app;

    /**
     * @param baxe_App_Abstract $app
     * @return unknown_type
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
     * Delete a blog post
     *
     * @param Blog_Post_VO $post
     * @return void
     */
    public function delete(Blog_Post_VO $post) {
        $blog = new Blog_Post_Gateway($this->app);
        $blog->markDeleted($post);
    }

    /**
     * Fetch the latest posts
     *
     * @param int $limit
     * @return Iterator<Blog_Post_VO>
     */
    public function fetchLatest($limit=5) {
        $blog = new Blog_Post_Gateway($this->app);
        return $blog->fetchLatest($limit);
    }

    /**
     * @param int $id
     * @return Blog_Post_VO
     * @throws Exception
     */
    public function load($id) {
        $blog = new Blog_Post_Gateway($this->app);
        return $blog->load($id);
    }

    /**
     * @param int $id
     * @return Blog_Post_VO
     * @throws Exception
     */
    public function loadOrCreate($id) {
        $blog = new Blog_Post_Gateway($this->app);
        return $blog->loadOrCreate($id);
    }

    /**
     * @param Blog_Post_VO $post
     * @param array $data
     * @return void
     */
    public function loadByArray(Blog_Post_VO $post, array $data) {
        $blog = new Blog_Post_Gateway($this->app);
        $blog->loadByArray($post, $data);
    }

    /**
     * @param Blog_Post_VO $post
     * @return void
     * @throws Exception
     */
    public function save(Blog_Post_VO $post) {
        $blog = new Blog_Post_Gateway($this->app);

        $ts = time();

        if (!$post->getId()) {
            $post->createdTs = $ts;
        }

        if (empty($post->slug)) {
            $this->generateSlug($post);
        }

        $post->lastUpdated = $ts;
        $blog->save($post);

        $pingback = new Blog_Pingback($this->app);
        $pingback->send($post);
    }

    /**
     * @return Iterator<Blog_Post_VO>
     * @throws Exception
     */
    public function fetchAll() {
        $blog = new Blog_Post_Gateway($this->app);
        return $blog->fetchAll();
    }

    /**
     * @return Iterator<Blog_Post_VO>
     * @throws Exception
     */
    public function fetchPublished() {
        $blog = new Blog_Post_Gateway($this->app);
        return $blog->fetchPublished();
    }

    /**
     * Generate a unique slug for this post
     *
     * @param Blog_Post_VO $post
     * @return void
     * @throws Exception
     */
    public function generateSlug(Blog_Post_VO $post) {
        $gateway = new Blog_Post_Gateway($this->app);
        $attempt = baxe_Util_PurdyString::generate($post->name);

        $inc = 1;
        while ($gateway->hasSlug($attempt)) {
            $attempt = $base .'-'. $inc . $ext;
            ++$inc;
        }

        $post->slug = $attempt;
    }

    /**
     * Load a post by its slug
     *
     * @return Blog_Post_VO
     * @throws Exception
     */
    public function loadBySlug($slug) {
        // memory optimization would be to store the post by id and then slug
        // pointing to the id.  but for now im doing this.
        $key  = "blog.post.slug.{$slug}";
        $post = apc_fetch($key);

        if ($post instanceof Blog_Post_VO) {
            return $post;
        }

        $gateway = new Blog_Post_Gateway($this->app);
        $post = $gateway->loadBySlug($slug);
        apc_store($key, $post, 60*60);
        return $post;
    }

}
