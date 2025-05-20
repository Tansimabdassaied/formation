<?php

// src/Controller/TrainingController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrainingController extends AbstractController
{
    private array $trainings;

    public function __construct()
    {
        $this->trainings = [
    [
        'id' => 1,
        'title' => 'Formation Symfony',
        'duration' => '3 jours',
        'description' => 'Apprenez à maîtriser Symfony, le framework PHP puissant et flexible.',
        'startDate' => new \DateTime('2025-06-01'),
        'instructor' => 'Jean Dupont',
    ],
    [
        'id' => 2,
        'title' => 'Formation IA',
        'duration' => '5 jours',
        'description' => 'Introduction aux concepts de l’intelligence artificielle et ses applications.',
        'startDate' => new \DateTime('2025-07-15'),
        'instructor' => 'Marie Curie',
    ],
    [
        'id' => 3,
        'title' => 'Formation JavaScript',
        'duration' => '4 jours',
        'description' => 'Les bases et avancées du langage JavaScript pour le développement web.',
        'startDate' => new \DateTime('2025-08-10'),
        'instructor' => 'Paul Martin',
    ],
    [
        'id' => 4,
        'title' => 'Formation DevOps',
        'duration' => '3 jours',
        'description' => 'Introduction aux pratiques DevOps pour améliorer la livraison logicielle.',
        'startDate' => new \DateTime('2025-09-05'),
        'instructor' => 'Sophie Bernard',
    ],
    [
        'id' => 5,
        'title' => 'Formation Docker',
        'duration' => '2 jours',
        'description' => 'Maîtrisez Docker pour la containerisation de vos applications.',
        'startDate' => new \DateTime('2025-10-12'),
        'instructor' => 'Ahmed Ali',
    ],
    [
        'id' => 6,
        'title' => 'Formation Python',
        'duration' => '4 jours',
        'description' => 'Apprenez le langage Python, très utilisé en IA et développement général.',
        'startDate' => new \DateTime('2025-11-20'),
        'instructor' => 'Claire Durand',
    ],
];

    }

    #[Route('/training', name: 'training')]
    public function index(): Response
    {
        return $this->render('training/index.html.twig', [
            'page_title' => 'Formations',
            'trainings' => $this->trainings,
        ]);
    }

    #[Route('/training/{id}', name: 'training_show')]
    public function show(int $id): Response
    {
        foreach ($this->trainings as $training) {
            if ($training['id'] === $id) {
                return $this->render('training/show.html.twig', [
                    'page_title' => $training['title'],
                    'training' => $training,
                ]);
            }
        }

        throw $this->createNotFoundException('Formation non trouvée.');
    }
}
