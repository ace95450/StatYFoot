<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnnonceRepository")
 */
class Annonce
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $featureImage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $spotlight;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $special;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie",
     *     inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre",
     *     inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getFeatureImage()
    {
        return $this->featureImage;
    }

    public function setFeatureImage($featureImage): self
    {
        $this->featureImage = $featureImage;

        return $this;
    }

    public function getSpotlight(): ?bool
    {
        return $this->spotlight;
    }

    public function setSpotlight(bool $spotlight): self
    {
        $this->spotlight = $spotlight;

        return $this;
    }

    public function getSpecial(): ?bool
    {
        return $this->special;
    }

    public function setSpecial(bool $special): self
    {
        $this->special = $special;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     * @return Annonce
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMembre()
    {
        return $this->membre;
    }

    /**
     * @param mixed $membre
     * @return Annonce
     */
    public function setMembre($membre)
    {
        $this->membre = $membre;
        return $this;
    }

}
