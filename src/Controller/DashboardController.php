<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    // Afficher la base de données clientèle et le dashboard
    #[Route('/tc/dashboard', name: 'app_tc_dashboard')]
    public function show(): Response
    {
        return $this->render('dashboard/index.html.twig');
    }

   
}
