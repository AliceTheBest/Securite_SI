<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class PasswordController extends Controller {

    /**
     * @Route("/password2", name="password2")
     */
	 public function index(\Swift_Mailer $mailer)
	{
	    $message = (new \Swift_Message('Hello Email'))
	        ->setFrom('alice.hubert@imie.fr')
	        ->setTo('{{app.user.email}}')
	        ->setBody(
	            $this->renderView(
	                'emails/email-reset-password.html.twig'
	            
	            ),
	            'text/html'
	        );
	
	    $mailer->send($message);
	
	    return $this->render('emails/confirmation-password.html.twig');
	}
	
}