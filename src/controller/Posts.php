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
        return new Response(datinmodel_array($beb),200);
    }

    protected function POST_return() : Response {
        $post = new PostModel();
        $post->setTitle('Gatya');
        return new Response(datinmodel_array($post->getWhere('title')),200);
    }

    protected function PUT_return() : Response {
        $post = new PostModel();
        $post->setId(3);
        $post->getThis('id');
        return new Response($post->getArray(),200);
    }

    protected function PATCH_return() : Response {
        return new Response(['message' => 'PATCH']);
    }

    protected function DELETE_return() : Response {
        return new Response(['message' => 'DELETE']);
    }



}