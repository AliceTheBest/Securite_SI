<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class PasswordController extends Controller {

    /**
     * @Route("/password", name="password")
     */
	 public function index(\Swift_Mailer $mailer)
	{
	    $message = (new \Swift_Message('Hello Email'))
	        ->setFrom('alice.hubert@imie.fr')
	        ->setTo('melanie.morin@imie.fr')
	        ->setBody(
	            $this->renderView(
	                // templates/emails/registration.html.twig
	                'emails/reset-password.html.twig'
	            
	            ),
	            'text/html'
	        )
	        /*
	         * If you also want to include a plaintext version of the message
	        ->addPart(
	            $this->renderView(
	                'emails/registration.txt.twig',
	                ['name' => $name]
	            ),
	            'text/plain'
	        )
	        */
	    ;
	
	    $mailer->send($message);
	
	    return $this->render('app_homepage_index');
	}
	
}