<?php
class Blog_Tag_Gateway extends baxe_DAO_GatewayAbstract {

    protected $metadata = array(
        'tagId' => array('type'=>self::TYPE_INT),
        'name'  => array('type'=>self::TYPE_STRING)
    );

    public function getPrimaryKey() {
        return 'tagId';
    }

    public function getTableName() {
        return 'blog_tag';
    }

    public function getVoClass() {
        return 'Blog_Tag_VO';
    }

    /**
     * Create a new Tag, save it to the db, & return its instance
     *
     * @param string $name
     * @return Blog_Tag_VO
     * @throws Exception
     */
    public function create($name) {
        $tag = $this->newVo();
        $tag->name = $name;
        $this->insert($tag);
        return $tag;
    }

    /**
     * Load a Tag by name
     *
     * @param string $name
     * @return Blog_Tag_VO
     * @throws Exception
     */
    public function loadByName($name) {
        $voClass = $this->getVoClass();
        $sql = "SELECT * FROM `". $this->getTableName() ."` WHERE `name`=:name";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $voClass);
        $stmt->execute(array(':name'=>$name));
        $tag = $stmt->fetch();
        if (!$tag instanceof $voClass) {
            throw new Exception("Unable to load tag {$name}");
        }
        return $tag;
    }

    /**
     *
     * @param Blog_Post_VO $post
     * @return Iterator<Blog_Tag_VO>
     * @throws Exception
     */
    public function loadByPost(Blog_Post_VO $post) {
        $ptGateway = new Blog_Post_Tag_Gateway($this->app); // Blog_Post_Gateway($this->app);
        $pt = $ptGateway->getTableName();
        $t  = $this->getTableName();

        $sql = "
        SELECT
            t.*
        FROM `$t` t
        INNER JOIN `$pt` pt USING (`tagId`)
        WHERE pt.`postId`=:postId
        ";

        $stmt = $this->getDb()->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->getVoClass());
        $stmt->execute(array(':postId'=>$post->postId));
        return $stmt;
    }

}
