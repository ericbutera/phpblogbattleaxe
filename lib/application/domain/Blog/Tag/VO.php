<?php
class Blog_Tag_VO extends baxe_DAO_VOAbstract {

    /**
     * @var int
     */
    public $tagId = 0;

    /**
     * @var string
     */
    public $name;

    public function getId() {
        return $this->tagId;
    }

}
