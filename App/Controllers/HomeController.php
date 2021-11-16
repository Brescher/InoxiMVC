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
    
    public function upload(){
        if (isset($_FILES['file'])) {
            if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
                $name = date('Y-m-d-H-i-s_') . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], Configuration::UPLOAD_DIR . "$name");
                $title = $_POST['title'];
                $text = $_POST['text'];
                $newEntry = new Entry();
                $newEntry->setImage($name);
                $newEntry->setTitle($title);
                $newEntry->setText($text);
                $newEntry->save();
            }
        }
        $this->redirect("home");
    }
}