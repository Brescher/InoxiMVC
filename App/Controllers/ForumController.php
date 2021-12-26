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

    public function forum()
    {
        return $this->html();
    }

    public function profile()
    {
        return $this->html();
    }
}