<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Client;
use App\Entity\User;
use App\Entity\Commercant;
use App\Entity\Particulier;
use App\Repository\UserRepository;

class DashboardController extends AbstractController
{
    // Afficher la base de données clientèle et le dashboard
    #[Route('/cc/dashboard/showClient', name: 'app_cc_show_dashboard', methods:["GET"])]
    public function show(ClientRepository $repoClient): Response
    {
        	$datas = $repoClient->findAll();
        return $this->render('dashboard/index.html.twig', [
           "datas"=>$datas
        ]);
    }

    
    #[Route('/cc/dashboard/createClient', name: 'app_cc_createClient', methods:["POST"])]
    public function create(Request $request, ClientRepository $repoClient, UserRepository $userRepository): Response
    {
        if ($request->request->has("btnSave")) {
            $nomComplet_Client = $request->request->get("nom");
            $emailClient =  $request->request->get("email");
            $adresseClient =  $request->request->get("adresse");
            $commercialId =  $request->request->get("commercial");
            $typeClient = $request->request->get("typeClient");
    
            dump($nomComplet_Client, $emailClient, $adresseClient, $commercialId, $typeClient);

            // Récupérer l'objet User correspondant à l'identifiant
            $commercial = $userRepository->find($commercialId);
    
            // Créer une nouvelle entité Client en fonction du type
            $client = match ($typeClient) { 
                'commercant' => new Commercant(),
                'particulier' => new Particulier(),
                default => new Client(), // Entité client générique par défaut
            };
    
            $client->setNomCompletClient($nomComplet_Client)
                   ->setEmailClient($emailClient)
                   ->setAdresseClient($adresseClient)
                   ->setCommercial($commercial);
    
            $repoClient->save($client, true);
    
            
        }
        return $this->redirectToRoute('app_cc_show_dashboard');
        
    }
    
    



    #[Route('/cc/dashboard/modifierClient', name: 'app_cc_modifierClient', methods:["GET"])]
    public function edit(): Response
    {
        return $this->render('dashboard/index.html.twig');
    }

    #[Route('/cc/dashboard/supprimerClient', name: 'app_cc_supprimerClient', methods:["GET"])]
    public function destroy(): Response
    {
        return $this->render('dashboard/index.html.twig');
    }

   
}
