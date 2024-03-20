<?php
// Commercant.php

namespace App\Entity;

use App\Repository\CommercantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommercantRepository::class)]
class Commercant extends Client
{
   

    public function __construct()
    {
        
    }

    // Les autres méthodes et propriétés de la classe
}

