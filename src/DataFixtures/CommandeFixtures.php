<?php


namespace App\DataFixtures;

use App\Entity\Commande;
use App\Entity\Client;
use App\Entity\Catalogue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Repository\ClientRepository;

class CommandeFixtures extends Fixture implements DependentFixtureInterface
{
    
    public function load(ObjectManager $manager)
    {
        // Créer 5 commandes de manière itérative
        for ($i = 0; $i < 5; $i++) {
            $commande = new Commande();
            $commande->setRefEmballage('REF123'.$i)
                ->setMoyenPaiement('Wave')
                ->setNbreVersement('1er Versement')
                ->setEtatCommande('Enregistré')
                ->setPreuvePaiement('preuve_paiement.pdf');

            // Récupérer un client existant (à remplacer par la logique nécessaire)
            $client = $manager->getRepository(Client::class)->findOneBy([]);

            if ($client instanceof Client) {
                $commande->setClient($client);
            } else {
            // Gestion de l'erreur si aucun client n'existe
                throw new \Exception('Aucun client trouvé pour associer à la commande.');
            }

            // Récupérer un catalogue existant (à remplacer par la logique nécessaire)
            $catalogue = $manager->getRepository(Catalogue::class)->findOneBy([]);

            if ($catalogue instanceof Catalogue) {
                $commande->setCatalogue($catalogue);
            } else {
                // Gestion de l'erreur si aucun catalogue n'existe
                throw new \Exception('Aucun catalogue trouvé pour associer à la commande.');
            }
            
            // Persist the command in the database
            $manager->persist($commande);
        }

        // Flush to execute SQL queries
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            UserFixtures::class,
            ClientFixtures::class
        ];
    }
}

