<?php
// src/Controller/ArticleController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    
    #[Route('/articles', name: 'articles')]
    public function index(): Response
    {
        $articles = [
            ['id' => 1, 'title' => 'Symfony 6: Les nouveautés', 'content' => 'Découvrez les dernières nouveautés de Symfony 6...'],
            ['id' => 2, 'title' => 'Introduction à l\'IA', 'content' => 'Un aperçu des concepts de base de l\'intelligence artificielle...'],
            ['id' => 3, 'title' => 'Comprendre le Machine Learning', 'content' => 'Le machine learning est un domaine fascinant qui permet aux machines...', 'publishedAt' => new \DateTime('2025-03-28')],
            ['id' => 4, 'title' => 'Les bases de la programmation', 'content' => 'La programmation est un ensemble de techniques permettant de...', 'publishedAt' => new \DateTime('2025-03-28')],
            ['id' => 5, 'title' => 'Développement web moderne', 'content' => 'Le développement web moderne implique l\'utilisation de nombreuses technologies...', 'publishedAt' => new \DateTime('2025-03-28')],
            ['id' => 6, 'title' => 'Les frameworks JavaScript', 'content' => 'Les frameworks JavaScript comme React, Vue.js et Angular sont très populaires...', 'publishedAt' => new \DateTime('2025-03-28')],
        ];

        return $this->render('article/index.html.twig', [
            'page_title' => 'Articles',
            'articles' => $articles,
        ]);
    }
#[Route('/articles/{id}', name: 'article_show')]
public function show(int $id): Response
{
    $articles = [
        ['id' => 1, 'title' => 'Symfony 6: Les nouveautés', 'content' => 'Découvrez les dernières nouveautés de Symfony 6...', 'publishedAt' => new \DateTime('2025-03-28')],
        ['id' => 2, 'title' => 'Introduction à l\'IA', 'content' => 'Un aperçu des concepts de base de l\'intelligence artificielle...', 'publishedAt' => new \DateTime('2025-04-01')],
        ['id' => 3, 'title' => 'Comprendre le Machine Learning', 'content' => 'Le machine learning est un domaine fascinant...', 'publishedAt' => new \DateTime('2025-03-28')],
        ['id' => 4, 'title' => 'Les bases de la programmation', 'content' => 'La programmation est un ensemble de techniques...', 'publishedAt' => new \DateTime('2025-03-28')],
        ['id' => 5, 'title' => 'Développement web moderne', 'content' => 'Le développement web moderne implique...', 'publishedAt' => new \DateTime('2025-03-28')],
        ['id' => 6, 'title' => 'Les frameworks JavaScript', 'content' => 'Les frameworks JavaScript comme React, Vue.js et Angular sont très populaires...', 'publishedAt' => new \DateTime('2025-03-28')],
    ];

    foreach ($articles as $article) {
        if ($article['id'] === $id) {
            return $this->render('article/show.html.twig', [
                'page_title' => $article['title'],
                'article' => $article,
            ]);
        }
    }

    throw $this->createNotFoundException('Article non trouvé.');
}

}
