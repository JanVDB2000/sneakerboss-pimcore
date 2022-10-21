<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;

class UserF extends BaseUser
{

    protected $id;

    public function __construct()
    {
        parent::__construct();

    }
}
