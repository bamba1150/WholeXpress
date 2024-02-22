<?php

namespace App\DataFixtures;

use App\Entity\Achat;
use App\Entity\Client;
use App\Entity\CA;
use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use App\Repository\CARepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AchatFixtures extends Fixture implements DependentFixtureInterface
{
    
   private ClientRepository $clientRepo;
   private CARepository $caRepo;

   public function __construct(ClientRepository $clientRepo,CARepository $caRepo)
   {
        $this->clientRepo = $clientRepo;
        $this->caRepo = $caRepo;
   }
    public function load(ObjectManager $manager): void
    {
        $bureaux = ["Beijing", "Shenzeng"];

        $date_estime = '2022-07-02';
        $date_est = new DateTime($date_estime);
        $date_string = '2022-01-02';
        $date = new DateTime($date_string);

        // Rechercher tous les clients
        $clients = $this -> clientRepo -> findAll();

       // Rechercher les utilisateurs avec le statut CA
    $role = "ROLE_CA";
    $users = $this->caRepo->findBy(['roles' => $role]);

    dump('Rôles des utilisateurs disponibles :');
    foreach ($users as $user) {
        dump($user->getRoles());
    }

    if (empty($users)) {
        // Gérer le cas où aucun utilisateur avec le rôle CA n'est trouvé
        throw new \Exception('Aucun utilisateur avec le rôle CA n\'a été trouvé.');
    }

        for($i=1; $i<=5; $i++)
        {
            $achat = new Achat;
            $achat -> setDate($date);
            foreach($bureaux as $bureau => $value)
            {
               $achat -> setCodeSortie($bureau."00".$i);
            }          
            $achat -> setDateArriveeEst($date_est)
                    -> setEtatAchat("Acheté")
                    -> setEtatComm("Client informé")
                    -> setFraisFournisseur(7500)
                    -> setFraisTransport(5000)
                    -> setMontantTTC(15000)
                    -> setModeExpedition(array_rand($bureaux))
                    -> setPreuvePaiement("URL IMAGE");
             
            // Affecter client a un achat
            $random_client = $clients[array_rand($clients)];
            $achat -> setClient($random_client);

            // Affecte un CA (User) a un achat
            $random_ca = $users[array_rand($users)];
            $achat -> setCa($random_ca);
            $manager ->  persist($achat);

        }

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
