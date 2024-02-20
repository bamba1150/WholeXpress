<?php

namespace App\Entity;

use App\Repository\ParticulierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticulierRepository::class)]
class Particulier extends Client
{
  
  public function getType()
  {
      return 'Particulier';
  }
  
}
