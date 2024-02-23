<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;
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
    public function create(): Response
    {
       dd($_POST);
        return $this->render('dashboard/index.html.twig');
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
