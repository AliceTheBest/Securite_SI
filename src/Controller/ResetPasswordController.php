<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ResetPasswordController extends AbstractController {

    /**
     * @Route("/password", name="password")
     */
    public function index(Request $request, \Swift_Mailer $mailer) {
    	// Création du formulaire pour récupérer l'adresse email
        $form = $this->get('form.factory')
                ->createNamedBuilder(null)
                ->add('_username', null, ['label' => 'Email'])
                ->add('ok', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Envoyer', 'attr' => ['class' => 'btn-primary btn-block']])
                // Au submit, la fonction resetPassword est utilisée
                // ->setAction($this->generateUrl('reset_password'))
                ->setMethod('GET')
                ->getForm();
        return $this->render('emails/reset-password.html.twig', [
                    'form' => $form->createView()
        ]);

        $name = $form['_username']->getData();
}

    /**
     * @Route("/reset_password", name="reset_password")
     */
	 public function resetPassword(\Swift_Mailer $mailer)
	{ 
		// Définition du mail a envoyer (expéditeur, destinataire, texte)
	    $message = (new \Swift_Message('Réinitialisation de mot de passe - AM Security'))
	        ->setFrom('alice.hubert@imie.fr')
	        ->setTo($name)
	        ->setBody(
	            $this->renderView(
	                'emails/email-reset-password.html.twig'
	            
	            ),
	            'text/html'
	        );
		// Le message est envoyé
	    $mailer->send($message);

	    // Affichage de la confirmation de l'envoi
	    return $this->render('emails/confirmation-password.html.twig');
	}

}