<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Repository\CCRepository")]
class CC extends User
{
    public function __construct()
    {
        parent::__construct();
        $this->setRoles(['ROLE_CC']);
    }
}

