<?php
class Blog_Post_VO extends baxe_DAO_VOAbstract {

    /**
     * @var int
     */
    public $postId = 0;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $copy;

    /**
     * @var int
     */
    public $allowComments = 0;

    /**
     * @var int
     */
    public $lastUpdated = 0;

    /**
     * @var int
     */
    public $createdTs = 0;

    /**
     * @var int
     */
    public $published;

    /**
     * @var string
     */
    public $teaser;

    /**
     * @var int
     */
    public $status = Blog_Post_Gateway::ACTIVE;

    /**
     * @var string
     */
    public $splashImage;

    /**
     * @var string
     */
    public $slug;

    /**
     * return the lastUpdated timestamp as a date string
     *
     * @return string
     */
    public function getLastUpdatedDate() {
        return date('F j, Y', $this->lastUpdated);
    }

    public function getCreatedTs() {
        return date('F j, Y', $this->createdTs);
    }

    public function getId() {
        return $this->postId;
    }

    /**
     * Get the textual value for if this post is published or not
     *
     * @return string
     */
    public function getPublishedLabel() {
        return (1 == $this->published) ? 'Yes' : 'No';
    }

    /**
     * Is this post published or not?
     *
     * @return bool
     */
    public function isPublished() {
        return (bool)$this->published;
    }

    public function allowComments() {
        return (bool)$this->allowComments;
    }

    /**
     * Returns a root relative permalink to a blog post.  It will not be the
     * absolute uri since that requires more overhead that can be fetched easier
     * outside of this class.
     *
     * @return string
     */
    public function getPermalink() {
        return "/post/view/". $this->slug;
    }
}
