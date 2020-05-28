<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoursRepository")
 * @Vich\Uploadable
 */
class Cours 
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
    private $file;




    /**
     * @Vich\UploadableField(mapping="user_contracts", fileNameProperty="file")
     * @var File
     */
    private $contractFile;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matiere", inversedBy="cours")
     */
    private $matiere;

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

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    public function getcontractFile()
    {
        return $this->contractFile;
    }
    /**
     * Undocumented function
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $contractFile
     * @return void
     */
    public function setcontractFile(?File  $contractFile=null)
    {
        $this->contractFile = $contractFile;
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
    public function __toString()
    {
        return $this->titre;
    }
}
