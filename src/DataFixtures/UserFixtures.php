<?php

// src/DataFixtures/UserFixtures.php

namespace App\DataFixtures;

use App\Entity\TC;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // Créer 5 utilisateurs fictifs
        for ($i = 1; $i <= 5; $i++) {
            $user = new TC();

            // Génération d'une adresse email unique
            $email = "user{$i}" . uniqid() . "@example.com";
            $user->setEmail($email);

            // Génération d'un mot de passe aléatoire
            $password = $faker->password;
            $user->setPassword(password_hash($password, PASSWORD_BCRYPT));

            $user->setRoles(['ROLE_TC']);
            $user->setTelephone($faker->phoneNumber);
            $user->setNomComplet($faker->name);
            // $user->setStatut("Actif"); // Vous pouvez ajuster le statut selon vos besoins

            $manager->persist($user);

            // Enregistrer une référence à l'utilisateur pour une utilisation dans d'autres fixtures
            $this->addReference('user_' . $i, $user);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AppFixtures::class // Supposant qu'il existe une fixture AppFixtures pour des données générales
        ];
    }
}
