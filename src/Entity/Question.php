<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
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
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Examen", inversedBy="questions")
     */
    private $examen;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Suggestions", mappedBy="question",fetch="EXTRA_LAZY",orphanRemoval=true,cascade={"persist"})
     */
    private $suggestions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReponsesEtudiant", mappedBy="question",)
     */
    private $reponsesEtudiants;

    public function __construct()
    {
        $this->suggestions = new ArrayCollection();
        $this->reponsesEtudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
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

    /**
     * @return Collection|Suggestions[]
     */
    public function getSuggestions(): Collection
    {
        return $this->suggestions;
    }

    public function addSuggestion(Suggestions $suggestion): self
    {
        if (!$this->suggestions->contains($suggestion)) {
            $this->suggestions[] = $suggestion;
            $suggestion->setQuestion($this);
        }

        return $this;
    }

    public function removeSuggestion(Suggestions $suggestion): self
    {
        if ($this->suggestions->contains($suggestion)) {
            $this->suggestions->removeElement($suggestion);
            // set the owning side to null (unless already changed)
            if ($suggestion->getQuestion() === $this) {
                $suggestion->setQuestion(null);
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
            $reponsesEtudiant->setQuestion($this);
        }

        return $this;
    }

    public function removeReponsesEtudiant(ReponsesEtudiant $reponsesEtudiant): self
    {
        if ($this->reponsesEtudiants->contains($reponsesEtudiant)) {
            $this->reponsesEtudiants->removeElement($reponsesEtudiant);
            // set the owning side to null (unless already changed)
            if ($reponsesEtudiant->getQuestion() === $this) {
                $reponsesEtudiant->setQuestion(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->question;
    }
}
