<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponsesEtudiantRepository")
 */
class ReponsesEtudiant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Examen", inversedBy="reponsesEtudiants")
     */
    private $examen;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="reponsesEtudiants")
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Suggestions", inversedBy="reponsesEtudiants")
     */
    private $suggestions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reponsesEtudiants")
     */
    private $etudiant;

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getExamen(): ?Examen
    {
        return $this->examen;
    }

    public function setExamen(?Examen $examen): self
    {
        $this->examen = $examen;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getSuggestions(): ?Suggestions
    {
        return $this->suggestions;
    }

    public function setSuggestions(?Suggestions $suggestions): self
    {
        $this->suggestions = $suggestions;

        return $this;
    }

    public function getEtudiant(): ?User
    {
        return $this->etudiant;
    }

    public function setEtudiant(?User $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }
}
