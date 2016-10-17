<?php
class manage_blog_postController extends AuthenticationController {


    public function indexAction() {
        return $this->listAction();
    }


    public function listAction() {
        $this->getLayout()->setPageTitle("Posts");
        $this->getLayout()->addMeta(array('name'=>'description', 'content'=>"Diary of a madman"));

        $postService = new Blog_Post_Service($this->app);
        $view = $this->getView();
        $view->posts = $postService->fetchAll();
        return $view->render("manage/blog/post/index.php");
    }

    public function formAction() {
        $postService = new Blog_Post_Service($this->app);

        if (isset($GLOBALS['blog.post'])) {
            $post = $GLOBALS['blog.post'];
        } else {
            $post = $postService->loadOrCreate(!empty($_GET['id']) ? (int)$_GET['id'] : 0);
        }

        $this->getLayout()->setPageTitle( ($post->getId()) ? 'Edit '. $post->name : 'Add Post' );

        $view = $this->getView();
        $view->post = $post;
        return $view->render("manage/blog/post/form.php");
    }

    public function deleteAction() {
        try {
            $id = !empty($_POST['id']) ? (int)$_POST['id'] : 0;
            $postService = new Blog_Post_Service($this->app);
            $post = $postService->load($id);

            $postService = Blog_Post_Service::getInstance($this->app);
            $postService->delete($post);

            $this->app->getFlash()->getMessage()->add("Deleted {$post->name}");
        } catch (Exception $e) {
            $this->app->getFlash()->getError()->add($e->getMessage());
        }
        return $this->controller->redirectToRoute("/manage/blog/post");
    }

    public function saveAction() {
        $request = $this->app->getRequest();
        if (baxe_App_Web_Request::POST !== $request->getMethod()) {
            throw new Exception("Invalid request");
        }

        $postService = new Blog_Post_Service($this->app);
        $post = $postService->loadOrCreate(!empty($_GET['id']) ? (int)$_GET['id'] : 0);

        $GLOBALS['blog.post'] = $post;

        $postService->loadByArray($post, $this->app->getRequest()->getPost());

        try {
            $handler = new Blog_Post_SplashImageHandler($this->app, $post);
            if (isset($_POST['deleteSplashImage']) &&
                strlen($post->splashImage)
            ) {
                $handler->remove($post->splashImage);
                $post->splashImage = null;
            }
        } catch (Exception $e) {}

        try {
            $postService->save($post);
        } catch (Exception $e) {
            $this->app->getFlash()->getError()->add($e->getMessage());
            return $this->controller->forward("/manage/blog/post/form");
        }

        if (isset($handler)) {
            try {
                $upload = new baxe_Upload;
                $file = $upload->process($handler);

                if ($file->name) {
                    $post->splashImage = $file->name;
                    $postService->save($post);
                }
            } catch (Exception $e) {
                // uploads are optional, so dont worry about this exception
            }
        }

        $tagService = Blog_Post_Tag_Service::getInstance($post);
        // $tagService->load();
        if (isset($_POST['tags'])) {
            $tagService->loadFromString($_POST['tags']);
        }
        $tagService->save();

        $this->app->getFlash()->getMessage()->add("Saved {$post->name}");
        return $this->controller->redirectToRoute("/manage/blog/post");
    }


}

