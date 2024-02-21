<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TcDashboardController extends AbstractController
{
    #[Route('/tc/dashboard', name: 'app_tc_dashboard')]
    public function index(): Response
    {
        return $this->render('tc_dashboard/index.html.twig', [
            'controller_name' => 'TcDashboardController',
        ]);
    }
}
