<?php 

namespace Ferid\Router\Tests\TestControllers;

class IndexController{

    public function index($param1)
    {
        dd($param1);
        return 'here is the index metheod of the IndexController';
    }
}