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

        return $this->render('member/index.html.twig', ['mainNavMember'=>true]);
    }

}