<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatieresController extends AbstractController
{
    /**
     * @Route("/matieres", name="matieres")
     */
    public function index()
    {
        $user=new User();
        $user=$this->getUser();
        return $this->render('matieres/index.html.twig', [
            'matieres' => $user->getClasse()->getMatieres(),
        ]);
    }
}
