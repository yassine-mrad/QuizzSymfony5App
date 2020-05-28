<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;


    private $roles ;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe", inversedBy="users")
     */
    private $classe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Matiere", mappedBy="enseignant")
     */
    private $matieres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReponsesEtudiant", mappedBy="etudiant")
     */
    private $reponsesEtudiants;

    public function __construct()
    {
        $this->matieres = new ArrayCollection();
        $this->reponsesEtudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        if(!$this->getClasse())
        {
            return ['ROLE_USER'];
        }
        else{
            return ['ROLE_USR'];
        }

        
    }

    

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection|Matiere[]
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
            $matiere->setEnseignant($this);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): self
    {
        if ($this->matieres->contains($matiere)) {
            $this->matieres->removeElement($matiere);
            // set the owning side to null (unless already changed)
            if ($matiere->getEnseignant() === $this) {
                $matiere->setEnseignant(null);
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
            $reponsesEtudiant->setEtudiant($this);
        }

        return $this;
    }

    public function removeReponsesEtudiant(ReponsesEtudiant $reponsesEtudiant): self
    {
        if ($this->reponsesEtudiants->contains($reponsesEtudiant)) {
            $this->reponsesEtudiants->removeElement($reponsesEtudiant);
            // set the owning side to null (unless already changed)
            if ($reponsesEtudiant->getEtudiant() === $this) {
                $reponsesEtudiant->setEtudiant(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->prenom . " " . $this->nom;
    }

}
