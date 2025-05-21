<?php
// src/Controller/ChatController.php
// src/Controller/ChatController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Psr\Log\LoggerInterface;


class ChatController extends AbstractController
{
    private $client;
    private $apiKey;
    private $logger;

    public function __construct(HttpClientInterface $client, ParameterBagInterface $params, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->apiKey = $params->get('openai_api_key');
        $this->logger = $logger;
    }

    #[Route('/chat', name: 'chat')]
    public function index(Request $request): Response
    {
        $userMessage = $request->query->get('message');
        $botReply = null;

        if ($userMessage) {
            try {
                $response = $this->client->request('POST', 'https://api.openai.com/v1/chat/completions', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'model' => 'gpt-4.1-turbo',
                        'messages' => [
                            ['role' => 'system', 'content' => 'Vous êtes un assistant utile.'],
                            ['role' => 'user', 'content' => $userMessage],
                        ],
                    'timeout' => 10,
                    ],
                ]);
                $data = $response->toArray();
                $botReply = $data['choices'][0]['message']['content'] ?? 'Pas de réponse.';
            } 
            catch (\Exception $e) {
              $this->logger->error('Erreur OpenAI : ' . $e->getMessage());
              $botReply = 'Erreur lors de la communication avec l’IA.';}        }

        return $this->render('chat/index.html.twig', [
            'page_title' => 'Chat avec IA',
            'botReply' => $botReply,
            'userMessage' => $userMessage,
        ]);
    }
}

