<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use App\Form\Type\ChangePasswordType;

/** @Route("/member") */
class MemberController extends Controller {

    /**
     * @Route("/")
     */
    public function index() {

        $form = $this->get('form.factory')
            ->createNamedBuilder(null)
            ->add('_current_password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, ['label' => 'Mot de passe actuel'])
            ->add('_new_password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, ['label' => 'Nouveau mot de passe'])
            ->add('_new_password_confirm', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, ['label' => 'Confirmer le nouveau mot de passe'])

            ->add('ok', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Modifier', 'attr' => ['class' => 'btn-primary btn-block']])
            ->getForm();

        return $this->render('member/index.html.twig', ['mainNavMember'=>true, 'form' => $form->createView()]);
    }

}