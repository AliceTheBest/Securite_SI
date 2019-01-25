<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use App\Form\Type\ChangePasswordType;

/** @Route("/member") */
class MemberController extends AbstractController {

    /**
     * @Route("/")
     */
    public function index (Request $request) {

        $form = $this->createFormBuilder()
            ->add('_current_password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, ['label' => 'Mot de passe actuel'])
            ->add('_new_password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, ['label' => 'Nouveau mot de passe'])
            ->add('_new_password_confirm', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, ['label' => 'Confirmer le nouveau mot de passe'])

            ->add('ok', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Modifier', 'attr' => ['class' => 'btn-primary btn-block']])
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                dump($form->getData());
                die();
                $newpass = $form['_new_password']->getData();
    
                $this->addFlash('success', 'nouveau mot de passe '+$newpass);
            }

        return $this->render('member/index.html.twig', ['mainNavMember'=>true, 'form' => $form->createView()]);
    }
    

}