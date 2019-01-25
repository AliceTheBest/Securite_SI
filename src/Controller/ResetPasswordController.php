<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Repository\UserRepository;

class ResetPasswordController extends AbstractController {

    /**
     * @Route("/password", name="password")
     */
    public function index(Request $request, \Swift_Mailer $mailer) {
    	// Création du formulaire pour récupérer l'adresse email
        $form = $this->get('form.factory')
                ->createNamedBuilder(null)
                ->add('_username', \Symfony\Component\Form\Extension\Core\Type\EmailType::class, ['label' => 'Email'])
                ->add('ok', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Envoyer', 'attr' => ['class' => 'btn-primary btn-block']])
                // Au submit, la fonction resetPassword est utilisée
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form['_username']->getData();
            $length = 10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
            $newpass = '';
        
            for ($p = 0; $p < $length; $p++) {
                $newpass .= $characters[mt_rand(0, strlen($characters))];
            }

            // Définition du mail a envoyer (expéditeur, destinataire, texte)
            $message = (new \Swift_Message('Réinitialisation de mot de passe - AM Security'))
            ->setFrom('alice.hubert@imie.fr')
            ->setTo($name)
            ->setBody(
                $this->renderView(
                    'emails/email-reset-password.html.twig', ['newpass'=>$newpass]       
                ),
                'text/html'
            );
            // Le message est envoyé
            $mailer->send($message);

            // Affichage de la confirmation de l'envoi
            return $this->render('emails/confirmation-password.html.twig', ['email_user'=>$name]);
        }
        else {
            //gestion de l'erreur
            $name = $form['_username']->getData();
            $usr = findOneBySomeField($name);
            dump($usr);
        }


        return $this->render('emails/reset-password.html.twig', [
            'form' => $form->createView()
        ]);
    }

}