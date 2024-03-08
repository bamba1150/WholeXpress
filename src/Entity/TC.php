<?php

namespace App\Entity;

use App\Repository\TCRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TCRepository::class)]
class TC extends User
{
    public function __construct()
    {
        $this->roles[]="ROLE_TC";
    }
}
