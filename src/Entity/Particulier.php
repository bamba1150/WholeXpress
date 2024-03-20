<?php
// Particulier.php

namespace App\Entity;

use App\Repository\ParticulierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticulierRepository::class)]
class Particulier extends Client
{
    
    public function __construct()
    {
        
    }

    // Les autres méthodes et propriétés de la classe
}

