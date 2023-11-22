<?php

namespace App\Controller;

use App\Entity\Planning;
use App\Entity\RendezVous;
use App\Form\RecommandeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[Route('/main')]
class VueClientController extends AbstractController
{
    #[Route('/', name: 'app_main', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $plannings = $entityManager
            ->getRepository(Planning::class)
            ->findAll();
    
        $images = [];
        foreach ($plannings as $key => $planning) {
            $images[$key] = base64_encode(stream_get_contents($planning->getImage()));
        }
    
        return $this->render('vueclient/acceuil.html.twig', [
            'plannings' => $plannings,
            'images' => $images,
        ]);
    }
    
    #[Route('/main/{id}', name: 'app_main_show', methods: ['GET'])]
    public function show(Planning $planning): Response
    {
        $image = $planning->getImage();

    // Convertir l'image en base64
    $base64Image = base64_encode(stream_get_contents($image));

    return $this->render('vueclient/show.html.twig', [
        'planning' => $planning,
        'base64Image' => $base64Image,
    ]);
}
#[Route('/main/{id}/recommande', name: 'app_main_recommande', methods: ['GET', 'POST'])]
public function recommande(Request $request, Planning $planning, MailerInterface $mailer): Response
{     
    
    
    if ($planning->getViews() >= 7) {
    $this->addFlash('error', 'Ce planning est saturé et ne peut pas être recommandé.');
    return $this->redirectToRoute('app_main');
}
    $rendezVous = new RendezVous();
    
    // Définir les valeurs de client, coach et planning
    $rendezVous->setIdClient($this->getUser());
    $rendezVous->setIdCoach($planning->getIdCoach());
    $rendezVous->setIdClient($this->getUser());
    $rendezVous->setPlanning($planning);

    $form = $this->createForm(RecommandeType::class, $rendezVous);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($rendezVous);
        $planning->setViews($planning->getViews() + 1);
        $entityManager->flush();

        // Créez un email
        $email = (new Email())
            ->from('hello@example.com')
            ->to($rendezVous->getIdCoach()->getMail())
            ->subject('Nouveau rendez-vous')
            ->text('Un nouveau rendez-vous a été pris.');


            
        // Envoyez l'email
        $mailer->send($email);

        return $this->redirectToRoute('app_main');
    }

    return $this->render('vueclient/recommande.html.twig', [
        'planning' => $planning,
        'recommande_form' => $form->createView(),
    ]);
}




}