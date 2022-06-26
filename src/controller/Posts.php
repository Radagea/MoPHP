<?php

namespace App\Src\Controller;

use App\App\Controller\ApiController;
use App\App\Controller\Response;
use App\App\Packages\Datin\Datin;

class Posts extends ApiController {
    protected function GET_return() : Response {
        $posts = array();
        $post['title'] = 'Lorem Ipsum';
        $post['desc'] = 'Lorem ipsum dolor sit amet...';
        $post['long'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis condimentum dolor nec tellus faucibus tristique vitae sit amet odio. Vivamus non massa at nisi finibus commodo. Donec sit amet dolor dolor. Aliquam non rhoncus est, id luctus tortor. Fusce interdum aliquet magna, non efficitur odio sodales in. Quisque ultrices lectus in scelerisque congue. Proin ac imperdiet massa. Donec ac ligula ornare, gravida ipsum et, interdum orci. Fusce elementum, tellus ut ultrices elementum, ante urna pulvinar neque, tincidunt cursus justo quam vel felis. Mauris laoreet libero a ipsum malesuada, id viverra erat bibendum. Suspendisse vitae quam a odio interdum convallis ut vitae felis. Vivamus quis ex pretium, molestie neque eu, sollicitudin quam. Sed a imperdiet lectus, non luctus ante.';
        $post['time'] = date('Y-m-d h:i:sa');
        array_push($posts,$post);
        $post['title'] = 'Lorem Ipsum 2';
        $post['desc'] = 'Lorem ipsum dolor sit amet...';
        $post['long'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis condimentum dolor nec tellus faucibus tristique vitae sit amet odio. Vivamus non massa at nisi finibus commodo. Donec sit amet dolor dolor. Aliquam non rhoncus est, id luctus tortor. Fusce interdum aliquet magna, non efficitur odio sodales in. Quisque ultrices lectus in scelerisque congue. Proin ac imperdiet massa. Donec ac ligula ornare, gravida ipsum et, interdum orci. Fusce elementum, tellus ut ultrices elementum, ante urna pulvinar neque, tincidunt cursus justo quam vel felis. Mauris laoreet libero a ipsum malesuada, id viverra erat bibendum. Suspendisse vitae quam a odio interdum convallis ut vitae felis. Vivamus quis ex pretium, molestie neque eu, sollicitudin quam. Sed a imperdiet lectus, non luctus ante.';
        $post['time'] = date('Y-m-d h:i:sa');
        array_push($posts,$post);
        $post['title'] = 'Lorem Ipsum 3';
        $post['desc'] = 'Lorem ipsum dolor sit amet...';
        $post['long'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis condimentum dolor nec tellus faucibus tristique vitae sit amet odio. Vivamus non massa at nisi finibus commodo. Donec sit amet dolor dolor. Aliquam non rhoncus est, id luctus tortor. Fusce interdum aliquet magna, non efficitur odio sodales in. Quisque ultrices lectus in scelerisque congue. Proin ac imperdiet massa. Donec ac ligula ornare, gravida ipsum et, interdum orci. Fusce elementum, tellus ut ultrices elementum, ante urna pulvinar neque, tincidunt cursus justo quam vel felis. Mauris laoreet libero a ipsum malesuada, id viverra erat bibendum. Suspendisse vitae quam a odio interdum convallis ut vitae felis. Vivamus quis ex pretium, molestie neque eu, sollicitudin quam. Sed a imperdiet lectus, non luctus ante.';
        $post['time'] = date('Y-m-d h:i:sa');
        array_push($posts,$post);
        Datin::get();
        return new Response($posts,201);
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