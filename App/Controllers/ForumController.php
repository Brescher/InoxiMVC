<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Models\Upost;
use App\Config\Configuration;

class ForumController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        $this->redirect("home");
    }

    public function forum()
    {
        $posts = Upost::getAll();

        return $this->html(
            [
                'posts' => $posts
            ]
        );
    }

    public function profile()
    {
        return $this->html();
    }

    public function updatepost()
    {
        return $this->html();
    }

    public function upload(){
        if (isset($_FILES['file'])) {
            if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
                session_start();
                $name = date('Y-m-d-H-i-s_') . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], Configuration::UPLOAD_DIR . "$name");
                $username = $_SESSION["username"];
                $text = $_POST['text'];
                $newUpost = new Upost();
                $newUpost->setUsername($username);
                $newUpost->setImage($name);
                $newUpost->setText($text);
                $newUpost->save();
                $this->redirect('forum', 'forum');
            }
        }
    }

    public function deletePost()
    {
        $postId = $this->request()->getValue('postid');
        if($postId > 0) {
            $post = Upost::getOne($postId);
            $name = $post->getImage();
            unlink(Configuration::UPLOAD_DIR . "$name");
            $post->delete();
        }
        $this->redirect('forum', 'forum');
    }

    public function update()
    {
        if (isset($_FILES['file'])) {
            $id = $this->request()->getValue('postid');
            $text = $_POST['text'];
            $newPost = new Upost();
            $newPost->setId($id);
            $newPost->setText($text);
            if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
                $name = date('Y-m-d-H-i-s_') . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], Configuration::UPLOAD_DIR . "$name");

                $oldPost = Upost::getOne($id);
                $oldName = $oldPost->getImage();
                unlink(Configuration::UPLOAD_DIR . "$oldName");

                $newPost->setImage($name);
                $newPost->save();
            } else {   //ak nie je aktualizovany obrazok, tak sa zoberie stary
                $post = Upost::getOne($id);
                $name = $post->getImage();
                $newPost->setImage($name);
                $newPost->save();
            }
        }
        $this->redirect('forum', 'forum');
    }
}