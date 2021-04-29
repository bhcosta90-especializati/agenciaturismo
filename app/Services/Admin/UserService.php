<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\UserContract;

class UserService {

    public function __construct(private UserContract $repo)
    {
        #    
    }

    public function pluck(){
        return $this->repo->pluck();
    }
}