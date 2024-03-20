<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Commercant;
use App\Entity\Particulier;
use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
     // Afficher la base de données clientèle et le dashboard
     #[Route('/dashboard/showClient', name: 'app_show_dashboard', methods:["GET"])]
     public function show(ClientRepository $repoClient, UserRepository $userRepository): Response
     {
        $datas = $repoClient->findAll();
        $users = $userRepository->findAll();
    
        $discriminants = array_map(fn($client) => $client->getType(), $datas);

    
        return $this->render('dashboard/index.html.twig', [
           "datas" => $datas,
           "users" => $users,
           "discriminants" => $discriminants,
        ]);
        return $this->redirectToRoute('app_createClient');
     }

     #[Route('/dashboard/createClient', name: 'app_createClient', methods:["POST"])]
     public function create(Request $request, ClientRepository $repoClient, UserRepository $userRepository, ClientRepository $clientRepository): Response
     {
        if ($request->request->has("btnSave")) {
            $nomComplet_Client = $request->request->get("nom");
            $emailClient = $request->request->get("email");
            $adresseClient = $request->request->get("adresse");
            $commercialId = $request->request->get("commercial");
            $typeClient = $request->request->get("typeClient");

            // Récupérer l'objet User correspondant à l'identifiant
            $commercial = $userRepository->find($commercialId);

            // Créer une nouvelle entité Client en fonction du type et passer le ClientRepository au constructeur
            $client = match ($typeClient) { 
                'commercant' => new Commercant($clientRepository),
                'particulier' => new Particulier($clientRepository),
                default => new Client($clientRepository), // Entité client générique par défaut
            };

            // Assurez-vous que le type de client est défini
            if ($client instanceof Client) {
                $client->setNomCompletClient($nomComplet_Client)
                    ->setEmailClient($emailClient)
                    ->setAdresseClient($adresseClient)
                    ->setCommercial($commercial);

                try {
                    // Enregistrer l'entité
                    $repoClient->save($client, true);

                    // Rediriger vers le tableau de bord
                    return $this->redirectToRoute('app_show_dashboard');
                } catch (\Exception $e) {
                    // Afficher un message d'erreur
                    $this->addFlash('error', $e->getMessage());

                    // Rediriger vers le formulaire d'ajout
                    return $this->redirectToRoute('app_createClient');
                }
            }

            // Gérer l'erreur de type client non défini
            $this->addFlash('error', 'Type de client non défini.');
            
        }

        return $this->redirectToRoute('app_show_dashboard');
    }

   
}

