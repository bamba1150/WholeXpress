<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\User;
use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class DashboardController extends AbstractController
{
    private $entityManager;
    private $clientRepository;
    private $userRepository;

    public function __construct(EntityManagerInterface $entityManager, ClientRepository $clientRepository, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    #[Route('/dashboard/createClient', name: 'app_createClient', methods: ['POST'])]
    public function createClient(Request $request): Response
    {
        // Récupération des données du formulaire
        $nom = $request->request->get('nom');
        $email = $request->request->get('email');
        $adresse = $request->request->get('adresse');
        $commercialId = $request->request->get('commercial');
        $typeClient = $request->request->get('typeClient');

        // Récupération de l'utilisateur commercial en charge
        $commercial = $this->userRepository->find($commercialId);

        // Création d'une nouvelle instance de Client
        $client = new Client();
        $client->setNomCompletClient($nom);
        $client->setEmailClient($email);
        $client->setAdresseClient($adresse);
        $client->setCommercial($commercial); // Association du commercial
        $client->setCodeClient($client->generateNextCode($typeClient)); // Génération du code client

        // Gestion du type de client (particulier ou commerçant)
        // Vous pouvez ajouter d'autres traitements spécifiques ici si nécessaire
dd($typeClient);
        // Sauvegarde du client en base de données
        $this->entityManager->persist($client);
        $this->entityManager->flush();

        // Redirection vers une page de confirmation ou une autre page de votre choix
        return $this->redirectToRoute('app_show_dashboard');
    }

    #[Route('/dashboard/showClient', name: 'app_show_dashboard', methods: ['GET'])]
    public function show(): Response
    {
        $datas = $this->clientRepository->findAll();
        $users = $this->userRepository->findAll();
        
    
        return $this->render('dashboard/index.html.twig', [
            "datas" => $datas,
            "users" => $users,
            
        ]);
    }
}
