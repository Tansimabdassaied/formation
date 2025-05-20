<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'about')]
    public function index(): Response
    {
        $companyInfo = [
            'title' => 'À propos de notre entreprise',
            'description' => "Nous sommes spécialisés dans la formation professionnelle, l'apprentissage en ligne et l'accompagnement pédagogique. Notre objectif est d'offrir des formations de qualité adaptées aux besoins des apprenants.",
            'mission' => "Offrir une éducation accessible, innovante et personnalisée.",
            'vision' => "Devenir un leader de la formation en ligne en francophonie.",
            'values' => ['Innovation', 'Excellence', 'Accessibilité', 'Engagement'],
        ];

        return $this->render('about/index.html.twig', [
            'page_title' => $companyInfo['title'],
            'info' => $companyInfo,
        ]);
    }
}
