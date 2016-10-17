<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/ckfinder/ckfinder.js"></script>

<div class="baxe-page">

    <div>
        <a href="<?php echo $this->createLink(array('route'=>'/manage/')) ?>">Manage</a>
        &raquo;
        <a href="<?php echo $this->createLink(array('route'=>'/manage/blog/post/')) ?>">Posts</a>
    </div>

    <h1><?php echo $this->post->getId() ? 'Edit' : 'Add' ?> Post</h1>

    <div>

    <form action="<?php echo $this->createLink(array('route'=>'/manage/blog/post/save', 'params'=>array('id'=>$this->post->getId()))) ?>" method="post" enctype="multipart/form-data">

    <table cellpadding="10" cellspacing="5">
    <tbody>
    <tr>
        <td>
        <h2>Name</h2>
        <input name="name" value="<?php echo $this->escape($this->post->name) ?>" style="width: 600px;" />
        </td>
    </tr>
    <tr>
        <td>
        <h2>Copy</h2>
        <p>
            <strong>To add a header image</strong>
            <code class="shell">&lt;img alt=&quot;&quot; class=&quot;splash&quot; src=&quot;/b/i/img.png&quot; /&gt;</code>
        </p>
        <p>
            <strong>To use fancybox try this:</strong>
<code class="shell">
&lt;a class=&quot;zoom&quot; rel=&quot;group&quot; href=&quot;/b/i/img.png&quot;&gt;
    &lt;img src=&quot;/b/i/img.png&quot; alt=&quot;Alt tag ftw&quot; /&gt;
&lt;/a&gt;
</code>
        </p>
        <textarea name="copy" cols="80" rows="15" style="width:500px; height: 600px"><?php echo $this->escape($this->post->copy) ?></textarea>
        </td>
    </tr>
    <tr>
        <td>
        <h2>Splash Image</h2>
        <?php if (strlen($this->post->splashImage)): ?>
            <?php
            $handler = new Blog_Post_SplashImageHandler($this->app, $this->post);
            ?>
            <div style="margin-bottom: 15px;">
            <img src="<?php echo $handler->getUrl() ."/". $this->post->splashImage ?>" width="150" style="border: 2px solid #4c4c4c;" />
            <br />
            <input type="checkbox" name="deleteSplashImage" id="deleteSplashImage" value="1" />
            <label for="deleteSplashImage">
            Delete
            </label>
            </div>
        <?php endif; ?>

        <input type="file" name="splashImage" />
        </td>
    </tr>
    <tr>
        <td>
        <h2>Teaser</h2>
        <textarea name="teaser" cols="80" rows="15" style="width:600px; height: 200px"><?php echo $this->escape($this->post->teaser) ?></textarea>
        </td>
    </tr>

    <tr>
        <td>
        <h2>Tags</h2>
        <p>Comma separated</p>
        <?php
        $tagService = Blog_Post_Tag_Service::getInstance($this->post);
        $tagService->load();
        ?>
        <input name="tags" value="<?php echo $this->escape($tagService->asText()) ?>" style="width: 600px;" />
        </td>
    </tr>

    <tr>
        <td>
        <label>
        <strong>Published?</strong>
        <input type="checkbox" name="published" value="1" <?php echo $this->post->isPublished() ? 'checked="checked"' : '' ?> />
        </label>
        </td>
    </tr>
    <tr>
        <td>
        <label>
        <strong>Comments?</strong>
        <input type="checkbox" name="allowComments" value="1" <?php echo $this->post->allowComments() ? 'checked="checked"' : '' ?> />
        </label>
        </td>
    </tr>
    <tr>
        <td>
        <input type="submit" value="Save" class="action" />
        </td>
    </tr>
    </tbody>
    </table>

    </form>

    </div>

</div>

<script type="text/javascript">
CKEDITOR.config.FormatSource = false ;
CKEDITOR.config.FormatOutput = false ;
CKEDITOR.config.protectedSource.push( /<code>.*<\/code>/g );
CKEDITOR.config.protectedSource.push( /<[^>]+class="shell"[^>\/]*\/>/g );
var editor = CKEDITOR.replace('copy', {
    width: 600,
    height: 500,
    contentsCss: '/css/axe/axe2.css'
});


CKEDITOR.on( 'instanceReady', function( ev )
	    {
	        // Out self closing tags the HTML4 way, like <br>.
	        ev.editor.dataProcessor.writer.setRules('code', {
	            indent : false,
	            breakBeforeOpen : false,
	            breakAfterOpen : false,
	            breakBeforeClose : false,
	            breakAfterClose : false
	        });
	        console.log(ev.editor.dataProcessor.writer);
	    });

CKFinder.SetupCKEditor( editor, '/ckfinder/' ) ;
// basePath, width, height, selectFunction
</script>
