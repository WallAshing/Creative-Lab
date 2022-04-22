<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Repository\ContactRepository;
use App\Service\ContactFormService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, ContactRepository $repository, ContactFormService $contactFormService): Response
    {
        if (!$this->redirectToRoute('app_login'))
        $formContact = new Contact();
        $form = $this->createForm(ContactFormType::class, $repository->new($this->getUser()));
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $contactFormService->handleContactForm($form);;
            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'contactForm' => $form->createView()
        ]);
    }
}
