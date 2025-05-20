<?php
// src/Controller/ContactController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\ContactMessage;
use Doctrine\ORM\EntityManagerInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $submitted = false;
        $errors = [];
        $name = '';
        $email = '';
        $message = '';

        if ($request->isMethod('POST')) {
            $name = trim($request->request->get('name'));
            $email = trim($request->request->get('email'));
            $message = trim($request->request->get('message'));

            // Validation simple
            if (empty($name)) {
                $errors[] = 'Le nom est obligatoire.';
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Un email valide est obligatoire.';
            }
            if (empty($message)) {
                $errors[] = 'Le message ne peut pas être vide.';
            }

            if (empty($errors)) {
                $contactMessage = new ContactMessage();
                $contactMessage->setName($name);
                $contactMessage->setEmail($email);
                $contactMessage->setMessage($message);
                $contactMessage->setCreatedAt(new \DateTime());

                $em->persist($contactMessage);
                $em->flush();

                $submitted = true;

                // Réinitialiser les champs après soumission réussie
                $name = $email = $message = '';
            }
        }

        return $this->render('contact/index.html.twig', [
            'page_title' => 'Contact',
            'submitted' => $submitted,
            'errors' => $errors,
            'name' => $name,
            'email' => $email,
            'message' => $message,
        ]);
    }

    #[Route('/contact/list', name: 'contact_list')]
    public function list(EntityManagerInterface $em): Response
    {
        $messages = $em->getRepository(ContactMessage::class)->findAll();

        return $this->render('contact/list.html.twig', [
            'page_title' => 'Liste des messages',
            'messages' => $messages,
        ]);
    }
}
