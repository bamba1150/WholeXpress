<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CommandeRepository;
use App\Entity\Client;
use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Catalogue;
use App\Repository\CatalogueRepository;
use App\Repository\ClientRepository;

class CommandeController extends AbstractController
{
    private $commandeRepository;
    private $entityManager;
    private $clientRepository;
    private $catalogueRepository;

    public function __construct(CommandeRepository $commandeRepository, EntityManagerInterface $entityManager, ClientRepository $clientRepository, CatalogueRepository $catalogueRepository)
    {
        $this->commandeRepository = $commandeRepository;
        $this->clientRepository = $clientRepository;
        $this->catalogueRepository = $catalogueRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/commande', name: 'app_commande')]
    public function showCommande(): Response
    {
        $commandes = $this->commandeRepository->findAll();
        $clients = $this->clientRepository->findAll();
        $catalogues = $this->catalogueRepository->findAll();

        return $this->render('commande/index.html.twig', [
          "commandes" => $commandes,
          "clients" => $clients,
          "catalogues" => $catalogues
        ]);
    }

    #[Route('/commande/create', name: 'app_createCommande', methods: ['POST'])]
    public function createCommande(Request $request): Response
    {
        // Récupérer les données du formulaire
        $date = new \DateTime($request->request->get('date'));
        $clientId = $request->request->get('client');
        $catalogueId  = $request->request->get('catalogue');
        $refEmballage = $request->request->get('ref_emballage');
        $moyenPaiement = $request->request->get('moyen_paiement');
        $nbreVersement = $request->request->get('nbre_versement');
        $expedition = $request->request->get('expedition');
        $montant = $request->request->get('montant');
        $etatCommande = $request->request->get('etat_commande');

        // Récupérer les entités Client et Catalogue correspondantes à partir de leurs IDs
        $client = $this->entityManager->getRepository(Client::class)->find($clientId);
        $catalogue = $this->entityManager->getRepository(Catalogue::class)->find($catalogueId);

        // Créer une nouvelle instance de Commande
        $commande = new Commande();
        $commande->setDate($date);
        $commande->setClient($client);
        $commande->setCatalogue($catalogue);
        $commande->setRefEmballage($refEmballage);
        $commande->setMoyenPaiement($moyenPaiement);
        $commande->setNbreVersement($nbreVersement);
        $commande->setExpedition($expedition);
        $commande->setMontantCommande($montant);
        $commande->setEtatCommande($etatCommande);

        // Enregistrer la commande
        $this->entityManager->persist($commande);
        $this->entityManager->flush();

        // Rediriger l'utilisateur vers une page de confirmation ou une autre page de votre choix
        return $this->redirectToRoute('app_commande');
    }
}
