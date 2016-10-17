<?php
class Blog_Post_Tag_Gateway {

    /**
     * @var baxe_App_Abstract
     */
    private $app;

    public function __construct(baxe_App_Abstract $app) {
        $this->app = $app;
    }

    public function getTableName() {
        return 'blog_post_tags';
    }

    /**
     * Delete Post Tag joins by a Post
     *
     * @param Blog_Post_VO $post
     * @return void
     * @throws Exception
     */
    public function deleteByPost(Blog_Post_VO $post) {
        $sql  = "DELETE FROM `". $this->getTableName() ."` WHERE `postId`=:postId";
        $stmt = $this->app->getDatabase()->prepare($sql);
        $stmt->execute(array(
            ':postId' => $post->getId()
        ));
    }

    /**
     * Save a Post Tag join
     *
     * @param Blog_Post_Tag_VO$vo
     * @return void
     * @throws Exception
     */
    public function save(Blog_Post_Tag_VO $vo) {
        $sql = "INSERT INTO `". $this->getTableName() ."` (`postId`, `tagId`) VALUES (:postId, :tagId)";
        $stmt = $this->app->getDatabase()->prepare($sql);
        $stmt->execute(array(
            ':postId'   => $vo->postId,
            ':tagId'    => $vo->tagId
        ));
    }

}
