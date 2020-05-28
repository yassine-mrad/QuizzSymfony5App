<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SuggestionsRepository")
 */
class Suggestions
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
    private $suggestions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="suggestions")
     */
    private $question;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReponsesEtudiant", mappedBy="suggestions")
     */
    private $reponsesEtudiants;

    /**
     * @ORM\Column(type="boolean")
     */
    private $validation;

    public function __construct()
    {
        $this->reponsesEtudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSuggestions(): ?string
    {
        return $this->suggestions;
    }

    public function setSuggestions(string $suggestions): self
    {
        $this->suggestions = $suggestions;

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
            $reponsesEtudiant->setSuggestions($this);
        }

        return $this;
    }

    public function removeReponsesEtudiant(ReponsesEtudiant $reponsesEtudiant): self
    {
        if ($this->reponsesEtudiants->contains($reponsesEtudiant)) {
            $this->reponsesEtudiants->removeElement($reponsesEtudiant);
            // set the owning side to null (unless already changed)
            if ($reponsesEtudiant->getSuggestions() === $this) {
                $reponsesEtudiant->setSuggestions(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->suggestions;
    }

    public function getValidation(): ?bool
    {
        return $this->validation;
    }

    public function setValidation(bool $validation): self
    {
        $this->validation = $validation;

        return $this;
    }
}
