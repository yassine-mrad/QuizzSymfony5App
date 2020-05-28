<?php

namespace App\Controller;

use App\Entity\Examen;
use App\Entity\Matiere;
use App\Entity\Suggestions;
use App\Entity\ReponsesEtudiant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExamensController extends AbstractController
{
    /**
     * @Route("/matieres/{id}/examens", name="examens")
     */
    public function examens(Matiere $m)
    {
        $matiere=new Matiere();
        $matiere=$m;
        return $this->render('examens/index.html.twig', [
            'examens' => $matiere->getExamens(),
            'matiere' => $matiere->getTitre(),
        ]);
    }


    /**
     * @Route("/examen/{id}", name="examen")
     */
    public function examen(Examen $examen)
    {
        $q=$examen->getQuestions();
        return $this->render('examens/examen.html.twig', [
            'q' => $q
        ]);
    }


    /**
     * @Route("/examens/reponses/{choix}", name="a")
     */
    public function resultat(Suggestions $choix,EntityManagerInterface $manager)
    {
        $ReponsesEtudiant = new ReponsesEtudiant();
        
        $ReponsesEtudiant->setEtudiant($this->getUser())
        ->setExamen($choix->getQuestion()->getExamen())
        ->setQuestion($choix->getQuestion())
        ->setSuggestions($choix);
        $manager->persist($ReponsesEtudiant);
        $manager->flush();
        return $this->json(['ok' => 'okk'],200);
        
       
    }
}
