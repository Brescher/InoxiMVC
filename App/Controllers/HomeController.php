<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Models\Entry;
use App\Config\Configuration;

/**
 * Class HomeController
 * Example of simple controller
 * @package App\Controllers
 */
class HomeController extends AControllerRedirect
{

    public function index()
    {

        $entrys = Entry::getAll();

        return $this->html(
            [
                'entrys' => $entrys
            ]
            );
    }

    public function entry()
    {
        return $this->html();
    }

    public function contact()
    {
        return $this->html();
    }

    public function update()
    {
        return $this->html();
    }
    
    public function upload(){
        if (isset($_FILES['file'])) {
            if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
                $name = date('Y-m-d-H-i-s_') . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], Configuration::UPLOAD_DIR . "$name");
                $title = $_POST['title'];
                $text = $_POST['text'];
                $textlen = strlen($text);
                $titlelen = strlen($title);
                if($titlelen > 100 || $titlelen < 10 || $textlen > 800 || $textlen < 100){
                    $this->redirect("home", "index");
                    exit();
                }
                $newEntry = new Entry();
                $newEntry->setImage($name);
                $newEntry->setTitle($title);
                $newEntry->setText($text);
                $newEntry->save();
                $this->redirect("home");
            }
        }
    }

    public function deleteEntry()
    {
        $entryId = $this->request()->getValue('entryid');
        if($entryId > 0) {
            session_start();
            $username = "becho";
            if(strcmp($_SESSION['username'], $username) === 0 ) {
                $entry = Entry::getOne($entryId);
                $name = $entry->getImage();
                unlink(Configuration::UPLOAD_DIR . "$name");
                $entry->delete();
            }
        }
        $this->redirect('home');
    }

    public function updateEntry()
    {
        if (isset($_FILES['file'])) {
            $id = $this->request()->getValue('entryid');
            $title = $_POST['title'];
            $text = $_POST['text'];
            $textlen = strlen($text);
            $titlelen = strlen($title);
            if($titlelen > 100 || $titlelen < 10 || $textlen > 800 || $textlen < 100){
                $this->redirect("home", "index");
                exit();
            }
            $newEntry = new Entry();
            $newEntry->setId($id);
            $newEntry->setTitle($title);
            $newEntry->setText($text);
            if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
                $name = date('Y-m-d-H-i-s_') . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], Configuration::UPLOAD_DIR . "$name");

                $oldEntry = Entry::getOne($id);
                $oldName = $oldEntry->getImage();
                unlink(Configuration::UPLOAD_DIR . "$oldName");

                $newEntry->setImage($name);
                $newEntry->save();
            } else {   //ak nie je aktualizovany obrazok, tak sa zoberie stary
                $entry = Entry::getOne($id);
                $name = $entry->getImage();
                $newEntry->setImage($name);
                $newEntry->save();
            }
        }
        $this->redirect("home");
    }
}