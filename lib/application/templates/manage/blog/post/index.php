<div class="baxe-page">

    <div>
        <a href="<?php echo $this->createLink(array('route'=>'/manage/')) ?>">Manage</a>
        &raquo;
        Posts
    </div>

    <h1>Posts</h1>

    <div>
        <a href="<?php echo $this->createLink(array('route'=>'/manage')) ?>" class="action">Manage</a>
    </div>

    <div>
        <a href="<?php echo $this->createLink(array('route'=>'/manage/blog/post/form')) ?>" class="action">Create Post</a>
    </div>

    <div>
        <table class="baxe-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Published</th>
            <th>Updated</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <?php $x = 0; ?>
        <?php foreach ($this->posts as $post): ?>
        <tr class="<?php echo ($x ^= 1) ? 'even' : 'odd' ?>">
            <?php /* @var $post Blog_Post_VO */ ?>
            <td><a href="<?php echo $this->createLink(array('route'=>'/manage/blog/post/form', 'params'=>array('id'=>$post->postId))) ?>"><?php echo $this->escape($post->name) ?></a></td>
            <td><?php echo $post->getPublishedLabel() ?></td>
            <td><?php echo $post->getLastUpdatedDate() ?></td>
            <td>
                <form action="<?php echo $this->createLink(array('route'=>'/manage/blog/post/delete')) ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $post->postId ?>" />
                <input type="submit" value="Delete" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        </table>
    </div>

</div>
