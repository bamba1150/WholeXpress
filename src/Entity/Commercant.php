<?php
// Commercant.php

namespace App\Entity;

use App\Repository\CommercantRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use App\Repository\ReclamationsRepository;

#[ORM\Entity(repositoryClass: CommercantRepository::class)]
class Commercant extends Client
{
    private UserRepository $userRepository;
    private ReclamationsRepository $reclamationsRepository;

    public function __construct(UserRepository $userRepository, ReclamationsRepository $reclamationsRepository)
    {
        $this->userRepository = $userRepository;
        $this->reclamationsRepository = $reclamationsRepository;
    }

    // Les autres méthodes et propriétés de la classe
}

