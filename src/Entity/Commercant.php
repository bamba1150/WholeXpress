<?php

namespace App\Entity;

use App\Repository\CommercantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommercantRepository::class)]
class Commercant extends Client
{
    public function __construct()
    {
        parent::__construct(); // Appeler le constructeur de la classe parente
      
    }
 
}
