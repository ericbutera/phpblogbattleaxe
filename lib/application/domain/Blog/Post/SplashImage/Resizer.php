<?php
class Blog_Post_SplashImage_Resizer {

    /**
     * @var Blog_Post_SplashImageHandler
     */
    private $handler;

    /**
     * @var Blog_Post_VO
     */
    private $post;

    private $width = 580;

    public function __construct(Blog_Post_SplashImageHandler $handler) {
        $this->handler = $handler;
        $this->post    = $handler->getPost();
        $this->generate();
    }

    public function getPath() {
        return $this->handler->getPath() ."/$this->width/". $this->post->splashImage;
    }

    public function getUrl() {
        return $this->handler->getUrl() ."/$this->width/". $this->post->splashImage;
    }

    /**
     * @throw Exception
     */
    private function generate() {
        $resizedPath =  dirname($this->getPath());
        if (!is_dir($resizedPath)) {
            mkdir($resizedPath, 0755, true);
        }

        $source = $this->handler->getPath() ."/". $this->post->splashImage;
        $dest = $resizedPath ."/". $this->post->splashImage;
        if (!file_exists($dest)) {
            $image = new baxe_Image_Adapter_Imagick;
            $image->load($source);

            // do not resize images that are the correct size or smaller
            $w = $image->getWidth();
            if ($this->width == $w || $this->width > $w) {
                copy($source, $dest);
                return;
            }

            $image->filter(new baxe_Image_Filter_ConstraintResize(
                baxe_Image_Filter_ConstraintResize::WIDTH,
                $this->width
            ));

            $image->getImagick()->setImageCompressionQuality(90);
            $image->save($dest);
        }
    }

}
