<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FacturationController extends AbstractController
{
    #[Route('/facturation', name: 'app_facturation', methods:["GET"])]
    public function index(): Response
    {
        return $this->render('facturation/index.html.twig', [
            
        ]);
    }
}
