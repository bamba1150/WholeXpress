<?php
// src/Service/CodeClientGenerator.php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Particulier;
use App\Entity\Commercant;

class CodeClientGenerator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function generateCode(string $typeClient): string
    {
        // Générer le code client avec le compteur formaté
        $codePrefix = ($typeClient === 'particulier') ? 'PART' : 'COM';
        $counter = $this->getCounter($typeClient);
        $code = $codePrefix . str_pad($counter, 3, '0', STR_PAD_LEFT);

        return $code;
    }

    private function getCounter(string $typeClient): int
    {
        $repository = match ($typeClient) {
            'particulier' => $this->entityManager->getRepository(Particulier::class),
            'commercant' => $this->entityManager->getRepository(Commercant::class),
            default => null,
        };

        if (!$repository) {
            // Gérer le cas où le type de client n'est pas reconnu
            throw new \InvalidArgumentException("Type de client non reconnu : $typeClient");
        }

        // Récupérer le nombre de clients de ce type
        $count = $repository->count([]);

        // Incrémenter le compteur et le retourner
        return $count + 1;
    }
}
