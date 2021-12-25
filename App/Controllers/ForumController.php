<?php

namespace App\Controllers;

use App\Core\Responses\Response;

class ForumController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        $this->redirect("home");
    }
}