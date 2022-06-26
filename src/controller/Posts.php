<?php

namespace App\Src\Controller;

use App\App\Controller\ApiController;
use App\App\Controller\Response;
use App\App\Packages\Datin\Datin;
use App\Src\Model\PostModel;
use App\Src\Model\Users;

class Posts extends ApiController {
    protected function GET_return() : Response {
        $asd = new PostModel();
        $beb = $asd->getAll();
        $output = array();
        foreach ($beb as $obj) {
            $objarr['id'] = $obj->getId();
            $objarr['title'] = $obj->getTitle();
            $objarr['description'] = $obj->getDescription();
            $objarr['content'] = $obj->getContent();
            array_push($output,$objarr);
        }
        return new Response($output,200);
    }

    protected function POST_return() : Response {
        $post = new PostModel();
        $post->setId(2);
        $output = [];
        if ($arr = $post->getWhere('id')) {
            if (is_array($arr)) {
                foreach ($arr as $key => $value) {
                    $obj['id'] = $value->getId();
                    $obj['title'] = $value->getTitle();
                    $obj['description'] = $value->getDescription();
                    $obj['content'] = $value->getContent();
                    array_push($output,$obj);
                }
            }
        }
        return new Response($output,200);
    }

    protected function PUT_return() : Response {
        return new Response(['message' => 'PUT']);
    }

    protected function PATCH_return() : Response {
        return new Response(['message' => 'PATCH']);
    }

    protected function DELETE_return() : Response {
        return new Response(['message' => 'DELETE']);
    }



}