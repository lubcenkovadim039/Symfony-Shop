<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\Table(name="products")
 */
class Product
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
    private $title;

    /**
     * @ORM\Column(type="decimal", precision=10,scale=2, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var Categery
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     * @ORM\JoinColumn(nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default" : 0})
     */
    private $isTop;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default" : "//placehold.it/300x200"})
     */
    private $image;



    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?Categery
    {
        return $this->category;
    }

    public function setCategory(?Categery $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getIsTop(): ?bool
    {
        return $this->isTop;
    }

    public function setIsTop(bool $isTop): self
    {
        $this->isTop = $isTop;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }





}
