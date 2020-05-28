<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExamenRepository")
 */
class Examen
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $durre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matiere", inversedBy="examens")
     */
    private $matiere;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="examen",fetch="EXTRA_LAZY",orphanRemoval=true,cascade={"persist"})
     */
    private $questions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReponsesEtudiant", mappedBy="examen")
     */
    private $reponsesEtudiants;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->reponsesEtudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDurre(): ?string
    {
        return $this->durre;
    }

    public function setDurre(string $durre): self
    {
        $this->durre = $durre;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setExamen($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getExamen() === $this) {
                $question->setExamen(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ReponsesEtudiant[]
     */
    public function getReponsesEtudiants(): Collection
    {
        return $this->reponsesEtudiants;
    }

    public function addReponsesEtudiant(ReponsesEtudiant $reponsesEtudiant): self
    {
        if (!$this->reponsesEtudiants->contains($reponsesEtudiant)) {
            $this->reponsesEtudiants[] = $reponsesEtudiant;
            $reponsesEtudiant->setExamen($this);
        }

        return $this;
    }

    public function removeReponsesEtudiant(ReponsesEtudiant $reponsesEtudiant): self
    {
        if ($this->reponsesEtudiants->contains($reponsesEtudiant)) {
            $this->reponsesEtudiants->removeElement($reponsesEtudiant);
            // set the owning side to null (unless already changed)
            if ($reponsesEtudiant->getExamen() === $this) {
                $reponsesEtudiant->setExamen(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->titre;
    }
}
