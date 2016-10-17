<?php foreach ($this->posts as $post): ?>
    <?php
    /* @var $post Blog_Post_VO */
    $permalink = $post->getPermalink();
    ?>
    <div class="topPost">
        <h2 class="topTitle"><a href="<?php echo $permalink ?>"><?php echo $this->escape($post->name) ?></a></h2>

        <p class="topMeta">
        by <a href="" title="Posts by Eric">Eric</a> on <?php echo $post->getLastUpdatedDate() ?>
        </p>

        <div class="topContent">
            <?php
            if (strlen($post->splashImage)):
                $handler = new Blog_Post_SplashImageHandler($this->app, $post);
                $resizer = new Blog_Post_SplashImage_Resizer($handler);

                if (file_exists($resizer->getPath())):
                    $d = getimagesize($resizer->getPath());
                    $url = $handler->getUrl() ."/600/". $post->splashImage;
                    echo '<img src="'. $resizer->getUrl() .'" alt="'. $this->escape($post->name) .'" '. $d[3] .' class="splash" />';
                endif;
            endif;
            ?>

            <p><?php echo $this->escape($post->teaser) ?></p>
        </div>

        <div class="cleared"></div>

        <div>
            <span class="topComments">
                <a href="<?php echo $permalink ."#comment" ?>" title="Comment on <?php echo $this->escape($post->name) ?>">
                0 Comments
                </a>
            </span>

            <?php /*
            <span class="topTags">
                <em>:</em>
                <a href="#tag" rel="tag">tag</a>,
                <a href="#tag2" rel="tag">tag2</a>
            </span>
            */ ?>

            <span class="topMore"><a href="<?php echo $permalink ?>">more…</a></span>
        </div>

        <div class="cleared"></div>
    </div>
<?php endforeach; ?>
