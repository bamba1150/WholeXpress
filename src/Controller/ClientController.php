<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    #[Route('/tc/client/show ', name: 'app_tc_client', methods:["GET"])]
    public function show(ClientRepository $repoClient): Response
    {
        	$datas = $repoClient->findAll();
        return $this->render('dashboard/index.html.twig', [
           "datas"=>$datas
        ]);
    }
    #[Route('/tc/dashboard/createClient', name: 'app_tc_createClient', methods:["POST"])]
    public function create(): Response
    {
        return $this->render('dashboard/index.html.twig');
    }

    #[Route('/tc/dashboard/modifierClient', name: 'app_tc_modifierClient', methods:["GET"])]
    public function edit(): Response
    {
        return $this->render('dashboard/index.html.twig');
    }

    #[Route('/tc/dashboard/supprimerClient', name: 'app_tc_supprimerClient', methods:["GET"])]
    public function destroy(): Response
    {
        return $this->render('dashboard/index.html.twig');
    }
}
