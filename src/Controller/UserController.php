<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/", name="Home")
     * @Route("/home", name="Home_anonyme")
     */
    public function home()
    {
        
        return $this->render('user/home.html.twig');
    }
}
