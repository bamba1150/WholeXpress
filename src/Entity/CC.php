<?php

namespace App\Entity;

use App\Repository\CCRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CCRepository::class)]
class CC extends User
{
    public function __construct()
    {
        $this->roles[]="ROLE_CC";
    }
}
