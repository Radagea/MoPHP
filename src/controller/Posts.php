<?php

namespace App\Src\Controller;

use App\App\Controller\ApiController;
use App\App\Controller\Response;

class Posts extends ApiController {
    protected function GET_return() : Response {
        return new Response(['message' => 'GET']);
    }

    protected function POST_return() : Response {
        return new Response(['message' => 'POST']);
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