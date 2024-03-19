<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(ClientRepository $repoClient): Response
    {
        $clients = $repoClient->findAll();
        return $this->render('commande/index.html.twig', [
           "clients" => $clients
        ]);
    }
}
