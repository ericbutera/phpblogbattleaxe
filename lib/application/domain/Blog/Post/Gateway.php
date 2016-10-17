<?php
class Blog_Post_Gateway extends baxe_DAO_GatewayAbstract {

    const ACTIVE    = 1;
    const DELETED   = 0;
    const PUBLISHED = 1;
    const DRAFT     = 0;

    protected $primary  = 'postId';
    protected $table    = 'blog_post';
    protected $voClass  = 'Blog_Post_VO';

    protected $metadata = array(
        'postId'        => array('type'=>self::TYPE_INT),
        'name'          => array('type'=>self::TYPE_STRING),
        'copy'          => array('type'=>self::TYPE_STRING),
        'allowComments' => array('type'=>self::TYPE_INT),
        'lastUpdated'   => array('type'=>self::TYPE_INT),
        'createdTs'     => array('type'=>self::TYPE_INT),
        'published'     => array('type'=>self::TYPE_INT),
        'teaser'        => array('type'=>self::TYPE_STRING)
    );

    public function getPrimaryKey() {
        return $this->primary;
    }

    public function getTableName() {
        return $this->table;
    }

    public function getVoClass() {
        return $this->voClass;
    }

    /**
     * Find N Latest posts
     *
     * @param $limit
     * @return PDOStatement
     * @throw Exception
     */
    public function fetchLatest($limit=5) {
        $sql = "
        SELECT * FROM `blog_post`
        WHERE `published`=1 AND `status`=:status
        ORDER BY `createdTs` DESC
        LIMIT :limit
        ";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->voClass);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':status', self::ACTIVE, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Get all posts
     *
     * @return PDOStatement
     * @throw Exception
     */
    public function fetchAll() {
        $sql = "SELECT * FROM `blog_post` WHERE `status`=:status ORDER BY `createdTs` DESC";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->voClass);
        $stmt->execute(array(
            ':status' => self::ACTIVE
        ));
        return $stmt;
    }

    /**
     * Get all posts
     *
     * @return PDOStatement
     * @throw Exception
     */
    public function fetchPublished() {
        $sql = "SELECT * FROM `blog_post` WHERE `published`=:published AND `status`=:status ORDER BY `createdTs` DESC";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->voClass);
        $stmt->execute(array(
            ':status'    => self::ACTIVE,
            ':published' => self::PUBLISHED
        ));
        return $stmt;
    }

    /**
     * (non-PHPdoc)
     * @see lib/library/baxe/DAO/baxe_DAO_GatewayAbstract#delete($vo)
     */
    public function markDeleted(Blog_Post_VO $post) {
        $sql = "UPDATE `{$this->table}` SET `status`=:status WHERE `{$this->primary}`=:pk";

        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute(array(
            ':status' => self::DELETED,
            ':pk'     => $vo->getId()
        ));
    }

    public function delete(baxe_DAO_VOAbstract $vo) {
        throw new Exception("Disabled");
    }

    /**
     * Check if a slug is in use or nt
     *
     * @param $slug
     * @return bool
     */
    public function hasSlug($slug) {
        $sql = "SELECT count(*) as slugCount FROM `{$this->table}` WHERE `slug`=:slug";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute(array(
            ':slug' => $slug
        ));
        return (bool)$stmt->fetch(PDO::FETCH_OBJ)->slugCount;
    }

    /**
     * Check if a slug is in use or nt
     *
     * @param $slug
     * @return bool
     */
    public function loadBySlug($slug, $useCached=true) {
        $vo = new Blog_Post_VO;

        $sql = "SELECT * FROM `{$this->table}` WHERE `slug`=:slug";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_INTO, $vo);
        $stmt->execute(array(':slug' => $slug));
        if (false === $stmt->fetch()) {
            throw new Exception("Unable to load {$this->id}");
        }
        return $vo;
    }

}
