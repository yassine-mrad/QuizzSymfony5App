<?php

namespace App\Controller;

use App\Entity\Matiere;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoursController extends AbstractController
{
    /**
     * @Route("/matieres/{id}/cours", name="cours")
     */
    public function index(Matiere $m)
    {
        $matiere=new Matiere();
        $matiere=$m;
        return $this->render('cours/index.html.twig', [
            'cours' => $matiere->getCours(),
            'matiere' => $matiere->getTitre(),
        ]);
    }
}
