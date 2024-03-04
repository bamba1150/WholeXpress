<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/cc/bufferCommande', name: 'app_cc_bufferCommande', methods:["GET"])]
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            
        ]);
    }
}
