<?php

namespace App\Entity;

use App\Repository\CARepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CARepository::class)]
class CA extends User
{
    public function __construct()
    {
        $this->roles[]="ROLE_CA";
    }
}
