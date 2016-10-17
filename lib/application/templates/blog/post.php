<?php
$post = $this->post; /* @var $post blog_Post_VO */
?>
<div class="topPost">
    <!-- start post -->
    <h2 class="topTitle"><a href="<?php echo $post->getPermalink() ?>"><?php echo $this->escape($post->name) ?></a></h2>

    <p class="topMeta">
    by <a href="" title="Posts by Eric">Eric</a> on <?php echo $post->getLastUpdatedDate() ?>
    </p>

    <div class="topContent">
        <p><?php echo $post->copy ?></p>

        <?php
        if (strlen($post->splashImage)):
            $handler = new Blog_Post_SplashImageHandler($this->app, $post);
            $resizer = new Blog_Post_SplashImage_Resizer($handler);
            $d = getimagesize($resizer->getPath());
            echo '<img src="'. $resizer->getUrl() .'" alt="'. $this->escape($post->name) .'" '. $d[3] .' class="splash" />';
        endif;
        ?>
    </div>

    <!-- end post -->

    <div class="cleared"></div>

    <?php /*
    @TODO comments
    <!-- start comments -->
    <em>Comments are not allowed.</em>
    <!-- end comments -->
    */ ?>

    <div class="cleared"></div>

</div>


