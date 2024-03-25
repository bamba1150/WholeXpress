<?php

namespace App\Controller;
use App\Entity\User;

use App\Entity\Commercant;
use App\Entity\Particulier;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    #[Route('/dashboard/showClient', name: 'app_show_dashboard', methods:["GET"])]
public function show(ClientRepository $repoClient, UserRepository $userRepository): Response
{
    $datas = $repoClient->findAll();
    $users = $userRepository->findAll();

    // Collecte des discriminants à partir de chaque client
    $discriminants = [];
    foreach ($datas as $client) {
        $discriminants[] = $client->getTypeClient();
    }
    return $this->render('dashboard/index.html.twig', [
        "datas" => $datas,
        "users" => $users,
        "discriminants" => $discriminants,
    ]);
}

    
    

    #[Route('/dashboard/createClient', name: 'app_createClient', methods:["POST"])]
    public function create(Request $request, EntityManagerInterface $entityManager, ClientRepository $clientRepository, UserRepository $userRepository): Response
    {
        $datas = $clientRepository->findAll();
        $users = $userRepository->findAll();

        // Création du formulaire
        $form = $this->createFormBuilder()
            ->add('nom', TextType::class, ['label' => 'Nom Complet'])
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('adresse', TextType::class, ['label' => 'Adresse'])
            ->add('commercial', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'nomComplet',
                'label' => 'Commercial en Charge'
            ])
            ->add('typeClient', ChoiceType::class, [
                'choices' => [
                    'Particulier' => 'particulier',
                    'Commercant' => 'commercant',
                ],
                'label' => 'Type de Client'
            ])
            ->add('enregistrer', SubmitType::class, ['attr' => ['class' => 'btn btn-success']])
            ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données soumises
            $data = $form->getData();
    
            // Déterminer le type de client en fonction des données soumises
            if ($data['typeClient'] === 'particulier') {
                // Créer un nouveau client Particulier
                $client = new Particulier($this->clientRepository);
            } else {
                // Créer un nouveau client Commercant
                $client = new Commercant($this->clientRepository);
            }
         
            // Assigner les données à l'entité Client
            $client->setNomCompletClient($data['nom']);
            $client->setEmailClient($data['email']);
            $client->setAdresseClient($data['adresse']);
            $client->setCommercial($data['commercial']);
            
            // Sauvegarder le client
            $entityManager->persist($client);
            $entityManager->flush();
          
            $this->addFlash('success', 'Client enregistré avec succès.');
    
            return $this->redirectToRoute('app_show_dashboard');
        }
    
        return $this->render('dashboard/index.html.twig', [
            'form' => $form->createView(),
            'datas' => $datas,
            'users' => $users
        ]);
    }
    
    
    
}
